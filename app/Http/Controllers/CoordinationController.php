<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Coordination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class CoordinationController extends Controller
{
    public function index()
    {
        $data = Coordination::with('namaKlien')->get();
        $cus = Customer::all();

        return view('pages.coordination.index', [
            'data'  => $data,
            'cus'  => $cus,
        ]);
    }

    public function store(Request $request)
    {
        Coordination::create([
            'client' => $request->client,
            'new_client' => $request->new_client,
            'date' => $request->date,
            'dept' => $request->dept,
            'permintaan' => $request->permintaan,
            'ket' => $request->ket,
            'fo' => $request->fo,
            'type_client' => $request->type_client,
            'user_id' => Auth::id()
        ]);
        return redirect()->back()->with('success', 'Data has been Added successfully.');
    }

    public function destroy($id)
    {
        $delete = Coordination::find($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Data has been Deleted successfully.');
    }
}