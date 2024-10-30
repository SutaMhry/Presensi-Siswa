<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\User;
use App\Models\AttendancePermit;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function dash()
    {
        return view('dashboard.student');
    }

    public function presence()
    {
        $presences = Presence::all();
        return view('presence.student', [
            'presences' => $presences,
        ]);
    }
    
    public function store(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();
        $date = now()->toDateString(); 
        $currentTime = now();
        $checkInTime = $currentTime->toTimeString(); 
    
        // Batas waktu check-in dan check-out
        $checkInStart = 6; // Jam 06:00
        $checkInLimit = 20; // Jam 07:00
        $checkOutStart = 20; // Jam 15:00
        $checkOutEnd = 21; // Jam 18:00
    
        // Temukan kehadiran yang sesuai untuk tanggal ini
        $presence = Presence::where('user_id', $userId)
                            ->where('date', $date)
                            ->first();
    
        // Validasi latitude dan longitude dari form
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
    
        // Rentang latitude dan longitude untuk lokasi SMKN 8 Jember
        $minLatitude = -8.1727;
        $maxLatitude = -8.1717;
        $minLongitude = 113.6990;
        $maxLongitude = 113.7000;
    
        // Validasi lokasi
        if ($latitude < $minLatitude || $latitude > $maxLatitude || $longitude < $minLongitude || $longitude > $maxLongitude) {
            return redirect()->back()->with('location_error', 'Gagal. Anda harus berada di lokasi SMKN 8 Jember untuk check-in/check-out.');
        }
    
        // Validasi check-in jika belum ada data kehadiran
        if (!$presence) {
            if ($currentTime->hour < $checkInStart || $currentTime->hour >= $checkInLimit) {
                return redirect()->back()->with('checkin_error', 'Hadir Gagal. Waktu Hadir 06.00 - 07.00.');
            }
    
            // Check-in
            Presence::create([
                'user_id' => $userId,
                'date' => $date,
                'check_in_time' => $checkInTime,
                'check_out_time' => null, 
                'information' => 'Hadir',
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
    
            return redirect()->route('presencestudent')->with('success', 'Check-in berhasil.');
        } else {
            if (!$presence->check_out_time) {
                if ($currentTime->hour < $checkOutStart || $currentTime->hour > $checkOutEnd) {
                    return redirect()->back()->with('checkout_error', 'Hadir Gagal. Waktu Pulang 15.00 - 18.00.');
                }
    
                // Check-out
                $checkOutTime = $currentTime->toTimeString(); 
                $presence->check_out_time = $checkOutTime; 
                $presence->information = 'Hadir';
                $presence->latitude = $latitude;
                $presence->longitude = $longitude;
                $presence->save(); 
    
                return redirect()->route('presencestudent')->with('success', 'Check-out berhasil.');
            }
        }
    
        return redirect()->route('presencestudent')->with('error', 'Anda sudah melakukan check-in dan check-out.');
    }
    
        
    
    public function admindash()
    {
        $presences = Presence::with('user')->get();
        return view('dashboard.admin', [
            'presences' => $presences,
        ]);
    }

    public function teacherdash()
    {
        $totalStudents = User::where('role', 'student')->count();

        $hadir = Presence::with('user')->where('information', 'Hadir')->get();
        $izin = Presence::with('user')->where('information', 'Izin')->get();
        $alpa = Presence::with('user')->where('information', 'Alpa')->get();

        return view('dashboard.teacher', [
            'totalStudents' => $totalStudents,
            'hadir' => $hadir,
            'izin' => $izin,
            'alpa' => $alpa,
        ]);
    }

    // Misalkan di PresencesController.php
    public function fetchPresenceMonthly(Request $request)
    {
        // Mengambil bulan dari request, default ke bulan ini
        $month = $request->input('month', date('Y-m'));
    
        // Ambil data berdasarkan bulan
        $presences = Presence::where('date', 'like', "$month%")->get();
    
        return view('presence.student', compact('presences')); // Ganti dengan nama view yang sesuai
    }
    


    public function studentsattendance () {
        $studentsattendance = Presence::with('user')->get();
            return view('presence.for-teacher', [
                'studentsattendance' => $studentsattendance,
            ]);
    }

    public function destroy (Presence $presence) {
        $presence->delete();
        return redirect('admindash');
    }
}
