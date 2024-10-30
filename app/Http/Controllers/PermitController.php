<?php

namespace App\Http\Controllers;
use App\Models\Permit;
use App\Models\User;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PermitController extends Controller
{
    public function index () {
        return view('presence.permit');
    }

    public function store(Request $request) {
        $request->validate([
            'date-permit' => 'required|date',
            'type-permit' => 'required|string|in:sakit,urusan-pribadi,lainnya',
            'reason' => 'required|string|max:255',
            'permit-file' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', 
            'information' => 'required|string|in:izin',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
    
        $input =  $request->all();
        $input['user_id'] = Auth::user()->id;
    
        if ($request->hasFile('permit-file')) {
            $image = $request->file('permit-file');
            $image_name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/image'), $image_name);
            $input['image'] = $image_name;
        }
    
        // Ambil latitude dan longitude dari request
        $input['latitude'] = $request->input('latitude');
        $input['longitude'] = $request->input('longitude');
    
        $permit = Permit::create($input);
    
        // Simpan data yang sama ke model Presence
        $presenceData = [
            'user_id' => $input['user_id'],
            'date' => $input['date-permit'],
            'information' => $input['information'],
            'check_in_time' => null, // Misalnya check-in saat ini
            'check_out_time' => null, // Misalnya check-out belum ada
            'permit_id' => $permit->id,
            'latitude' => $input['latitude'],    // Tambahkan latitude
            'longitude' => $input['longitude'],    // Tambahkan longitude
        ];
    
        Presence::create($presenceData);
    
        return redirect('permit')->with('success', 'Izin berhasil terkirim');
    }
    
    
}
