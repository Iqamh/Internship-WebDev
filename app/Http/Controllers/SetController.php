<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SetController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('welcome', compact('user'));
    }

    public function form()
    {
        return view('forms');
    }

    public function store(Request $request)
    {
        // Validate
        $this->validate($request, [
            'file' => 'required|mimes:pdf',
        ]);
        
        $user = new User;
        $user->nama = $request->input('nama');
        $user->nim = $request->input('nim');
        $user->noHP = $request->input('noHP');
        $user->email = $request->input('email');
        $user->institusi = $request->input('institusi');
        $user->fakultas = $request->input('fakultas');
        $user->jurusan = $request->input('jurusan');
        $user->waktu_mulai = $request->input('waktu_mulai');
        $user->waktu_selesai = $request->input('waktu_selesai');
        $user->judul = $request->input('judul');
        $user->rekomendasi = $request->input('rekomendasi');
        $user->surat = $request->input('surat');
        $user->bidang = $request->input('bidang');

        // Saving File
        if ($request->file('file')){  
            $file = $request->file('file');
            $destinationPath = public_path('file');
            $viewfile = 'file/';         
            $filename = $viewfile.$file->getClientOriginalName();
            $file->move($destinationPath, $filename); 
            $user->file = $filename;
            // THIS TO SAVE  Settings UPDATE //
            $user->save(); 
          }else{
            $user->save();  
          }
        
        $user->save();

        return redirect()->back()->with('Messagge', 'Message');
    }

    public function index2()
    {
        $user = User::all();
        return view('admin', compact('user'));
    }
    
    public function upStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'new_status' => 'required|in:0,1,2,3,4',
        ]);

        $newStatus = $request->new_status;

        // Panggil metode untuk menentukan perubahan status otomatis
        if ($user->status == 1 && $newStatus == 2) {
            $newStatus = $user->isWithinDateRange() ? 2 : $newStatus;
        } elseif ($user->status == 2 && $newStatus == 3) {
            $newStatus = $user->isPastEndDate() ? 3 : $newStatus;
        }

        // Perbarui status
        $user->status = $newStatus;
        $user->save();

        return redirect()->route('admin.dashboard');
    }

}