<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\reportOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::where('post_order', '34')->get();
        $email = Auth::user()->email;

        // Inisialisasi array untuk menyimpan email dan ID klien
        $postDateKlienArray = [];
        $postKlienArray = [];
        $postIdArray = [];

        foreach ($order as $value) {

            // Pastikan relasi 'user' ada dan emailnya bisa diakses
            if ($value->user && $value->user->email == $email) {
                $postIdArray[] = $value->id_order;
                $postIdQlArray[] = $value->penawaran_order;
                $postKlienArray[] = $value->user->email;
                $postDateKlienArray[] = $value->tgl_order;
            }
        }

        // dd($postIdArray, $postDateKlienArray, $postIdQlArray);

        foreach ($postIdArray as $index => $clientId) {
            // Periksa apakah entri dengan order_id sudah ada
            $existingEntry = reportOrder::where('order_id', $clientId)->exists();

            // Jika tidak ada entri yang sama, buat entri baru
            if (!$existingEntry) {
                reportOrder::create([
                    'order_id' => $clientId,
                    'tgl_order' => $postDateKlienArray[$index] ?? null,
                    'no_ql_id' => $postIdQlArray[$index] ?? null,
                    'user_id' => Auth::id()
                ]);
            }
        }
        $data = Order::all();
        $datas = reportOrder::with('order.ql.client')->get();
        $usData = reportOrder::where('user_id', Auth::id())->get();
        return view('pages.order.index', [
            'data'    => $data,
            'datas'    => $datas,
            'usData'    => $usData,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $order = Order::where('no_order', $request->order_id)->first();
        $unitPrices = str_replace(['.', ','], '', $request->amount);

        // dd($unitPrices);

        reportOrder::create([
            'order_id' => $order->id_order,
            'no_ql_id' => $order->penawaran_order,
            'amount' => $unitPrices,
            'tgl_order' => $order->tgl_order,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('orders.index')->with('success', 'Data has been Added successfully.');
    }

    public function destroy($id)
    {
        $delete = reportOrder::find($id);
        $delete->delete();

        return redirect()->route('orders.index')->with('success', 'Data has been Deleted successfully.');
    }
}
