<?php

namespace App\Http\Controllers;

use App\Models\QLSend;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QLSendController extends Controller
{
    public function index()
    {
        $ql = Quotation::where('post_penawaran', '37')->get();
        $email = Auth::user()->email;

        // Inisialisasi array untuk menyimpan email dan ID klien
        $postDateQlArray = [];
        $postQlArray = [];
        $postIdArray = [];

        // Loop melalui setiap Customer untuk mendapatkan email pengguna terkait
        foreach ($ql as $value) {
            // Pastikan relasi 'user' ada dan emailnya bisa diakses
            if ($value->user && $value->user->email == $email) {
                $postIdArray[] = $value->id_penawaran;
                $postQlArray[] = $value->user->email;
                $postDateQlArray[] = $value->date_penawaran;
            }
        }

        // dd($postIdArray, $postDateQlArray);


        foreach ($postIdArray as $index => $clientId) {
            $existingEntry = QLSend::where('no_ql_id', $clientId)->exists();

            // Jika tidak ada entri yang sama, buat entri baru
            if (!$existingEntry) {
                QLSend::create([
                    'no_ql_id' => $clientId,
                    'date' => $postDateQlArray[$index] ?? null,
                    'user_id' => Auth::id()
                ]);
            }
        }


        // Pertama, muat relasi utama
        $data = QLSend::with('noQL')->get();
        $data->load('noQL.user');
        $usData = QLSend::with('noQL.user')->where('user_id', Auth::id())->get();

        return view('pages.ql-send.index', [
            'data' => $data,
            'usData' => $usData,
            'ql' => $ql,
        ]);
    }

    public function store(Request $request)
    {
        QLSend::create([
            'no_ql_id'  => $request->no_ql_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('quotation-letter.index')->with('success', 'Data has been Added successfully.');
    }

    public function destroy($id)
    {
        $delete = QLSend::find($id);
        $delete->delete();
        return redirect()->route('quotation-letter.index')->with('success', 'Data has been Deleted successfully.');
    }
}