<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index () {
        return view('profile.profile');
    }

    public function admin(Request $request)
    {
        // Ambil keyword dari request
        $keyword = $request->input('keyword');
    
        // Cek apakah ada keyword yang dicari
        if ($keyword) {
            // Cari admin berdasarkan keyword
            $admins = User::where('role', 'admin')
                ->where(function($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                           ->orWhere('email', 'like', "%{$keyword}%");
                })
                ->get();
        } else {
            // Jika tidak ada keyword, ambil semua admin
            $admins = User::where('role', 'admin')->get();
        }
    
        // Cek apakah data admin kosong
        $noDataMessage = $admins->isEmpty() ? "Tidak ada data admin yang ditemukan." : null;
    
        return view('user-management.user.admin', [
            'users' => $admins, // Daftar admin
            'noDataMessage' => $noDataMessage, // Pesan jika tidak ada data
        ]);
    }
    
    
    
    
    
    public function student(Request $request)
    {
        // Ambil keyword dari request
        $keyword = $request->input('keyword');
    
        // Cek apakah ada keyword yang dicari
        if ($keyword) {
            // Cari siswa berdasarkan keyword
            $students = User::where('role', 'student')
                ->where(function($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                           ->orWhere('nisn', 'like', "%{$keyword}%");
                })
                ->get();
        } else {
            // Jika tidak ada keyword, ambil semua siswa
            $students = User::where('role', 'student')->get();
        }
    
        // Cek apakah data siswa kosong
        $noDataMessage = $students->isEmpty() ? "Tidak ada data siswa yang ditemukan." : null;
    
        return view('user-management.user.student', [
            'users' => $students, // Daftar siswa
            'noDataMessage' => $noDataMessage, // Pesan jika tidak ada data
        ]);
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create () 
    {
        // Mengambil Data Kelas
        $classrooms = Classroom::all();
        
        // Cek route name untuk menentukan apakah sedang menambah murid atau guru
        $route = request()->route()->getName();
                    
        // Tentukan role berdasarkan route
        if ($route == 'create-student') {
            $role = 'student';
        } elseif ($route == 'create-teacher') {
            $role = 'teacher';
        } elseif ($route == 'create-admin') { 
            $role = 'admin';
        } else {
            $role = null; 
        }
    
        // Kirim variabel 'role' ke view
        return view('user-management.create.create-user', compact('role', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'nullable|numeric|digits:10',
            'nip' => 'nullable|numeric|digits:18',
            'birth' => 'nullable|date',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:3 ',
            'role' => 'required|string|in:teacher,student,admin',
            'telp' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $input =  $request->all();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/image'), $image_name);
            $input['image'] = $image_name;
        }

        $user = User::create($input);

        if ($user->role == 'student') {
            return redirect()->route('student-management')->with('successcreateuser', 'Data berhasil disimpan');
        } elseif ($user->role == 'teacher') {
            return redirect()->route('teacher-management')->with('successcreateuser', 'Data berhasil disimpan');
        } else {
            return redirect()->route('admin-management')->with('successcreateuser', 'Data berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Temukan data user berdasarkan ID
        $user = User::findOrFail($id);

        // Tentukan role berdasarkan role user
        $role = $user->role;

        // Ambil data kelas jika role adalah student
        $classrooms = $role === 'student' ? Classroom::all() : null;

        // Kirimkan user, role, dan classrooms ke view
        return view('user-management.create.edit', compact('user', 'role', 'classrooms'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        
        // 2. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'nullable|numeric|digits:10',
            'nip' => 'nullable|numeric|digits:18',
            'birth' => 'nullable|date',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'email' => 'required|email|unique:users,email,' . $user->id, // Pastikan email unik kecuali untuk user ini
            'password' => 'nullable|string|min:3', // Password bisa nullable jika tidak diupdate
            'role' => 'required|string|in:teacher,student,admin',
            'telp' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // 3. Update data user
        $input = $request->all();

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/image'), $image_name);
            $input['image'] = $image_name;
        }

        // Cek dan update password jika ada input baru
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        } else {
            unset($input['password']); // Jangan update password jika tidak ada input baru
        }

        // Update user dengan data baru
        $user->update($input);
        
        // Redirect berdasarkan peran user
        if ($user->role == 'student') {
            return redirect()->route('student-management')->with('successcreateuser', 'Data berhasil diperbarui');
        } elseif ($user->role == 'teacher') {
            return redirect()->route('teacher-management')->with('successcreateuser', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('admin-management')->with('successcreateuser', 'Data berhasil diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Users::find($id);

        // Jika user ditemukan, hapus user tersebut
        if ($user) {
            $user->delete();
            return redirect()->back()->with('successdeleteuser', 'User berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    }
}
