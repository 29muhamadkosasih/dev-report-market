<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\NewClientCall;
use Illuminate\Support\Facades\Auth;

class NewClientCallController extends Controller
{
    public function index()
    {
        $cus = Customer::where('post_klien', '!=', '13')->get(); // Mengambil semua data Customer
        $email = Auth::user()->email;

        // Inisialisasi array untuk menyimpan email dan ID klien
        $postDateKlienArray = [];
        $postKlienArray = [];
        $postIdArray = [];

        // Loop melalui setiap Customer untuk mendapatkan email pengguna terkait
        foreach ($cus as $value) {
            // Pastikan relasi 'user' ada dan emailnya bisa diakses
            if ($value->user && $value->user->email == $email) {
                $postIdArray[] = $value->id_klien;
                $postKlienArray[] = $value->user->email;
                $postDateKlienArray[] = $value->date_klien;
            }
        }

        // Tampilkan data yang telah dikumpulkan untuk debugging
        // dd($postIdArray, $postDateKlienArray);

        // Pastikan untuk menambahkan data ke NewClientCall dengan cara yang benar
        foreach ($postIdArray as $index => $clientId) {
            // Periksa apakah entri dengan client_id sudah ada
            $existingEntry = NewClientCall::where('client_id', $clientId)->exists();

            // Jika tidak ada entri yang sama, buat entri baru
            if (!$existingEntry) {
                NewClientCall::create([
                    'client_id' => $clientId,
                    'date' => $postDateKlienArray[$index] ?? null,
                    'user_id' => Auth::id()
                ]);
            }
        }





        $data = NewClientCall::all();
        $usData = NewClientCall::where('user_id', Auth::id())->get();
        return view('pages.client-call.index', [
            'data' => $data,
            'cus'  => $cus,
            'usData'  => $usData,

        ]);
    }

    public function store(Request $request)
    {
        NewClientCall::create([
            'client_id' => $request->client_id,
            'date' => $request->date,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('new-client-call.index')->with('success', 'Data has been Added successfully.');
    }


    public function edit($id)
    {
        $edit = NewClientCall::find($id);
        $cus = Customer::all();
        $data = NewClientCall::all();
        $usData = NewClientCall::where('user_id', Auth::id())->get();


        return view('pages.client-call.index', [
            'edit'  => $edit,
            'data' => $data,
            'cus'  => $cus,
            'usData'  => $usData,

        ]);
    }

    public function update(Request $request, $id)
    {
        $edit = NewClientCall::find($id);
        $edit->update([
            'client_id' => $request->client_id,
            'date' => $request->date,
        ]);

        return redirect()->route('new-client-call.index')->with('success', 'Data has been Updated successfully.');
    }
    public function destroy($id)
    {
        $delete = NewClientCall::find($id);
        $delete->delete();
        return redirect()->route('new-client-call.index')->with('success', 'Data has been Deleted successfully.');
    }
}