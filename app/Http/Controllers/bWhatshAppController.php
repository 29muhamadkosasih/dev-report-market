<?php

namespace App\Http\Controllers;

use App\Models\bWhatshApp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class bWhatshAppController extends Controller
{
    public function index()
    {
        $data = bWhatshApp::all();
        $usData = bWhatshApp::where('user_id', Auth::id())->get();
        return view('pages.blasting-whatsapp.index', [
            'data' => $data,
            'usData' => $usData,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi file dan data lainnya
        $request->validate([
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:10048',
            'type_flayer' => 'required|string',
            'date' => 'required|date',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            // Ambil file yang diupload
            $file = $request->file('file');
            $userName = Auth::user()->name;
            $random = Str::lower(Str::random(5)); // Membuat string acak sepanjang 5 karakter
            $formattedUserName = strtolower(str_replace(' ', '-', $userName));
            $fileName = 'lampiran-whatsapps-' . $formattedUserName . '-' . $random . '.' . $file->getClientOriginalExtension();

            // Tentukan path penyimpanan relatif terhadap disk 'public'
            $destinationPath = 'uploads/lampiran-whatsapps';

            // Simpan file ke disk 'public'
            $file->storeAs($destinationPath, $fileName, 'public');
        }

        // Simpan data ke database
        bWhatshApp::create([
            'type_flayer' => $request->type_flayer,
            'date' => $request->date,
            'file' => $fileName,
            'user_id' => Auth::id(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('blasting-whatsapp.index')->with('success', 'Data has been added successfully.');
    }

    public function edit($id)
    {
        $edit = bWhatshApp::find($id);
        $data = bWhatshApp::all();
        $usData = bWhatshApp::where('user_id', Auth::id())->get();

        return view('pages.blasting-whatsapp.index', [
            'edit' => $edit,
            'data' => $data,
            'usData' => $usData,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Cari entitas yang akan diperbarui
        $whatsapp = bWhatshApp::find($id);

        if (!$whatsapp) {
            // Jika entitas tidak ditemukan, redirect dengan pesan error
            return redirect()->back()->with('error', 'Data not found.');
        }

        // Defaultkan ke nama file lama
        $fileName = $whatsapp->file;

        if ($request->hasFile('file')) {
            // Ambil file yang diupload
            $file = $request->file('file');
            $userName = Auth::user()->name;
            $random = Str::lower(Str::random(5)); // Membuat string acak sepanjang 5 karakter
            $formattedUserName = strtolower(str_replace(' ', '-', $userName));
            $fileName = 'lampiran-whatsapps-' . $formattedUserName . '-' . $random . '.' . $file->getClientOriginalExtension();

            // Tentukan path penyimpanan relatif terhadap disk 'public'
            $destinationPath = 'uploads/lampiran-whatsapps';

            // Hapus file lama jika ada
            $oldFilePath = $destinationPath . '/' . $whatsapp->file;
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Simpan file baru ke disk 'public'
            $file->storeAs($destinationPath, $fileName, 'public');

            // Perbarui data file di database
            $whatsapp->file = $fileName;
        }

        // Perbarui data lain di database
        $whatsapp->update([
            'type_flayer' => $request->type_flayer,
            'date' => $request->date,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('blasting-whatsapp.index')->with('success', 'Data has been updated successfully.');
    }

    public function destroy($id)
    {
        $delete = bWhatshApp::find($id);

        if (!$delete) {
            // Jika entitas tidak ditemukan, redirect dengan pesan error
            return redirect()->route('blasting-whatsapp.index')->with('error', 'Data not found.');
        }

        // Tentukan path file menggunakan disk 'public'
        $filePath = 'uploads/lampiran-whatsapps/' . $delete->file;

        // Cek apakah file ada sebelum menghapusnya
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        } else {
            // Jika file tidak ada, log atau pesan error
            return redirect()->route('blasting-whatsapp.index')->with('warning', 'File not found.');
        }

        // Hapus entitas dari database
        $delete->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('blasting-whatsapp.index')->with('success', 'Data has been deleted successfully.');
    }
}
