<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil keyword dari request
        $keyword = $request->input('keyword');
    
        // Ambil data kelas dengan guru wali kelas dan hitung jumlah siswa
        $classrooms = Classroom::with('hmteacher') // Mengaitkan data guru wali kelas
            ->withCount(['students' => function ($query) {
                $query->where('role', 'student');
            }])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhereHas('hmteacher', function ($q) use ($keyword) {
                             $q->where('name', 'like', "%{$keyword}%");
                      });
            })
            ->get();
    
        // Pesan jika tidak ada data ditemukan
        $noDataMessage = $classrooms->isEmpty() ? "Tidak ada data kelas yang ditemukan." : null;
    
        return view('classrooms.classroom', compact('classrooms', 'noDataMessage'));
    }
    
    
    

    public function teacher(Request $request)
    {
        $keyword = $request->input('keyword');
    
        $query = Classroom::with('hmteacher'); // Ambil data classroom dan guru yang relevan
    
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhereHas('hmteacher', function ($query) use ($keyword) {
                      $query->where('name', 'like', "%{$keyword}%")
                            ->orWhere('nip', 'like', "%{$keyword}%");
                  });
            });
        }
    
        $classrooms = $query->get();
    
        return view('user-management.user.teacher', [
            'classrooms' => $classrooms,
            'noDataMessage' => $classrooms->isEmpty() ? "Tidak ada data guru yang ditemukan." : null,
        ]);
    }
    
    
    
    
    




    public function detail($name)
    {
        $classroom = Classroom::where('name', $name)->firstOrFail();
        return view('classrooms.classroom-detail', compact('classroom'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil hanya ID dan nama dari guru
        $teachers = User::where('role', 'teacher')->pluck('name', 'id');

        return view('classrooms.create-classroom', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hmteacher' => 'required|exists:users,id', // Validasi untuk memastikan ID guru ada di database
        ]);

    
        // Simpan kelas baru
        Classroom::create([
            'name' => $request->name,
            'hmteacher_id' => $request->hmteacher,
        ]);
    
        return redirect()->route('create-classroom')->with('successcreateclassroom', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $user = User::with('hmteacher')->find($id); // Mengambil user beserta relasi hmteacher
        return view('classroom.edit-user', compact('user'));
    }


    public function editClassroom($id)
    {
        $classroom = Classroom::findOrFail($id);
        $teachers = User::where('role', 'teacher')->pluck('name', 'id'); // Ambil semua guru

        return view('classrooms.edit-classroom', compact('classroom', 'teachers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'hmteacher' => 'required|exists:users,id', // Pastikan hmteacher ada di tabel users
        ]);
    
        // Temukan classroom berdasarkan ID dan perbarui data
        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->all());
    
        return redirect()->route('classroom-management')->with('successcreateuser', 'Data kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classroom-management')->with('success', 'Classroom deleted successfully.');
    }
}
