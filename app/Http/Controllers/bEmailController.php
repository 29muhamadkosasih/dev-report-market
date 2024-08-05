<?php

namespace App\Http\Controllers;

use App\Models\bEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class bEmailController extends Controller
{
    public function index()
    {
        $data = bEmail::all();
        $usData = bEmail::where('user_id', Auth::id())->get();
        return view('pages.blasting-email.index', [
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
            $originalName = $file->getClientOriginalName();
            $userName = Auth::user()->name;
            $random = Str::lower(Str::random(5)); // Membuat string acak sepanjang 5 karakter
            $formattedUserName = strtolower(str_replace(' ', '-', $userName));
            $fileName = 'lampiran-emails-' . $formattedUserName . '-' . $random . '.' . $file->getClientOriginalExtension();

            // Tentukan path penyimpanan relatif terhadap disk 'public'
            $destinationPath = 'uploads/lampiran-emails';

            // Simpan file ke disk 'public'
            $file->storeAs($destinationPath, $fileName, 'public');
        }

        // Simpan data ke database
        bEmail::create([
            'type_flayer' => $request->type_flayer,
            'date' => $request->date,
            'file' => $fileName,
            'user_id' => Auth::id(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('blasting-email.index')->with('success', 'Data has been added successfully.');
    }


    public function edit($id)
    {
        $edit = bEmail::find($id);
        $data = bEmail::all();
        $usData = bEmail::where('user_id', Auth::id())->get();

        return view('pages.blasting-email.index', [
            'edit' => $edit,
            'data' => $data,
            'usData' => $usData,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Cari entitas yang akan diperbarui
        $email = bEmail::find($id);

        if (!$email) {
            // Jika entitas tidak ditemukan, redirect dengan pesan error
            return redirect()->back()->with('error', 'Data not found.');
        }

        // Defaultkan ke nama file lama
        $fileName = $email->file;

        if ($request->hasFile('file')) {
            // Ambil file yang diupload
            $file = $request->file('file');
            $userName = Auth::user()->name;
            $random = Str::lower(Str::random(5)); // Membuat string acak sepanjang 5 karakter
            $formattedUserName = strtolower(str_replace(' ', '-', $userName));
            $fileName = 'lampiran-emails-' . $formattedUserName . '-' . $random . '.' . $file->getClientOriginalExtension();

            // Tentukan path penyimpanan relatif terhadap disk 'public'
            $destinationPath = 'uploads/lampiran-emails';

            // Hapus file lama jika ada
            $oldFilePath = $destinationPath . '/' . $email->file;
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Simpan file baru ke disk 'public'
            $file->storeAs($destinationPath, $fileName, 'public');

            // Perbarui data file di database
            $email->file = $fileName;
        }

        // Perbarui data lain di database
        $email->update([
            'type_flayer' => $request->type_flayer,
            'date' => $request->date,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('blasting-email.index')->with('success', 'Data has been updated successfully.');
    }



    public function destroy($id)
    {
        $delete = bEmail::find($id);

        if (!$delete) {
            // Jika entitas tidak ditemukan, redirect dengan pesan error
            return redirect()->route('blasting-email.index')->with('error', 'Data not found.');
        }

        // Tentukan path file menggunakan disk 'public'
        $filePath = 'uploads/lampiran-emails/' . $delete->file;

        // Cek apakah file ada sebelum menghapusnya
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        } else {
            // Jika file tidak ada, log atau pesan error
            return redirect()->route('blasting-email.index')->with('warning', 'File not found.');
        }

        // Hapus entitas dari database
        $delete->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('blasting-email.index')->with('success', 'Data has been deleted successfully.');
    }
}
