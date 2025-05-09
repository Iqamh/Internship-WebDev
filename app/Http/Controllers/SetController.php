<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class SetController extends Controller
{
    public function index()
    {
        $totalDiproses = User::where('role', 'ketua')->where('status', 0)->count();
        $totalBerlangsung = User::where('role', 'ketua')->where('status', 1)->where('waktu_mulai', '<=', now())->where('waktu_selesai', '>=', now())->count();
        $totalSelesai = User::where('role', 'ketua')->where('status', 1)->where('waktu_selesai', '<', now())->count();
        $totalDitolak = User::where('role', 'ketua')->where('status', 4)->count();

        $groups = User::where('role', 'ketua')->with('anggota')->paginate();
        return view('user.welcome', compact('groups', 'totalDiproses', 'totalBerlangsung', 'totalSelesai', 'totalDitolak'));
    }

    public function form()
    {
        return view('user.forms');
    }

    public function store(Request $request)
    {
        // Validasi
        $this->validate($request, [
            'file' => 'required|mimes:pdf',
        ]);

        // Membuat group_id sebagai identifier untuk kelompok inputan
        $group_id = uniqid();

        // Simpan data ketua
        $ketua = new User;
        $ketua->group_id = $group_id;
        $ketua->role = "ketua";
        $ketua->nama = $request->input('nama_ketua');
        $ketua->nim = $request->input('nim_ketua');
        $ketua->noHP = $request->input('noHP');
        $ketua->email = $request->input('email');
        $ketua->institusi = $request->input('institusi');
        $ketua->fakultas = $request->input('fakultas');
        $ketua->jurusan = $request->input('jurusan');
        $ketua->waktu_mulai = $request->input('waktu_mulai');
        $ketua->waktu_selesai = $request->input('waktu_selesai');
        $ketua->judul = $request->input('judul');
        $ketua->rekomendasi = $request->input('rekomendasi');
        $ketua->surat = $request->input('surat');
        $ketua->bidang = $request->input('bidang');

        // Simpan data anggota
        $namaAnggota = $request->input('nama_anggota');
        $nimAnggota = $request->input('nim_anggota');

        if (!empty($namaAnggota) && !empty($nimAnggota)) {
            $namaAnggota = explode(',', $namaAnggota);
            $nimAnggota = explode(',', $nimAnggota);

            foreach ($namaAnggota as $key => $nama) {
                $anggota = new User;
                $anggota->group_id = $group_id;
                $anggota->role = "anggota";
                $anggota->nama = trim($nama); // Menghapus spasi di awal dan akhir nama
                $anggota->nim = trim($nimAnggota[$key]); // Sesuaikan nim anggota dengan nama
                // Simpan anggota ke dalam database
                $anggota->save();
            }
        }

        // Simpan file jika ada
        if ($request->file('file')) {
            $file = $request->file('file');
            $destinationPath = public_path('file');
            $viewfile = 'file/';
            $filename = $viewfile . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $ketua->file = $filename;
        }

        // Simpan data ketua ke dalam database
        $ketua->save();

        return redirect()->back()->with('Messagge', 'Message');
    }

    public function index2()
    {
        $totalDiproses = User::where('role', 'ketua')->where('status', 0)->count();
        $totalBerlangsung = User::where('role', 'ketua')->where('status', 1)->where('waktu_mulai', '<=', now())->where('waktu_selesai', '>=', now())->count();
        $totalSelesai = User::where('role', 'ketua')->where('status', 1)->where('waktu_selesai', '<', now())->count();

        $groups = User::where('role', 'ketua')->with('anggota')->paginate(15);

        return view('admin.admin', compact('groups', 'totalDiproses', 'totalBerlangsung', 'totalSelesai'));
    }

    public function upStatus(Request $request, $id)
    {
        // Validasi
        $this->validate($request, [
            'new_status' => 'required|in:0,1,4',
        ]);

        // Temukan ketua berdasarkan ID
        $ketua = User::findOrFail($id);

        // Perbarui status ketua
        $ketua->status = $request->input('new_status');
        $ketua->save();

        // Perbarui status anggota yang memiliki group_id yang sama dengan ketua
        $anggotaList = User::where('group_id', $ketua->group_id)->where('role', 'anggota')->get();

        foreach ($anggotaList as $anggota) { // Ubah variabel di sini
            $anggota->status = $request->input('new_status');
            $anggota->save();
        }

        return redirect()->route('admin.dashboard');
    }

    public function updateBidangKetua(Request $request, $id)
    {
        // Validasi
        $this->validate($request, [
            'new_bidang' => 'required|in:0,1,2,3,4,5,6',
        ]);

        $ketua = User::findOrFail($id);

        $ketua->bidang = $request->input('new_bidang');
        $ketua->save();

        return redirect()->route('admin.dashboard');
    }

    public function updateBidangAnggota(Request $request, $id)
    {
        // Validasi
        $this->validate($request, [
            'new_bidang' => 'required|in:0,1,2,3,4,5,6',
        ]);

        $anggota = User::findOrFail($id);

        $anggota->bidang = $request->input('new_bidang');
        $anggota->save();

        return redirect()->route('admin.dashboard');
    }

    public function updateSurat(Request $request, $groupId)
    {
        try {
            $ketua = User::where('group_id', $groupId)->where('role', 'ketua')->first();

            if ($ketua) {
                // Update ketua's rekomendasi
                $ketua->surat = $request->input('surat_ketua', null);
                $ketua->save();

                // Update anggota's rekomendasi
                $anggotaSurat = $request->input('surat_anggota', []);

                $anggotaList = User::where('group_id', $groupId)->where('role', 'anggota')->get();
                foreach ($anggotaList as $index => $anggota) {
                    if (isset($anggotaSurat[$index])) {
                        $anggota->surat = $anggotaSurat[$index];
                        $anggota->save();
                    }
                }

                // Return a response (e.g., success message)
                return response()->json(['message' => 'Updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Group ketua not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $ketua = User::findOrFail($id);
        File::delete($ketua->file);
        $ketua->delete();

        $anggotaList = User::where('group_id', $ketua->group_id)->where('role', 'anggota')->get();

        foreach ($anggotaList as $anggota) {
            $anggota->delete();
        }

        return redirect()->route('admin.dashboard')->with('Messagge', 'Message');
    }

    public function downloadPdf($filename)
    {
        // Decode kembali nama file yang telah dienkoding
        $decodedFilename = urldecode($filename);

        // Hilangkan karakter "/" dari nama file
        $decodedFilename = str_replace('/', '', $decodedFilename);

        $file = public_path('file/' . $decodedFilename);

        if (file_exists($file)) {
            return response()->download($file);
        } else {
            abort(404);
        }
    }
}