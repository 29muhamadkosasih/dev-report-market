<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = User::whereNotIn('id', [1])->get();
        $data = Report::all();
        return view('pages.report.index', [
            'user' => $user,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $revenue = $request->revenue;
        $revenue = str_replace(['.', ','], '', $revenue ?? '0');
        $dateMont = $request->month . '-01';
        Report::create([
            'user_id' => $request->user_id,
            'month' => $dateMont,
            'client_call' => $request->client_call,
            'blasting_email' => $request->blasting_email,
            'blasting_whatsapp' => $request->blasting_whatsapp,
            'client_visit' => $request->client_visit,
            'ql_send' => $request->ql_send,
            'pen_po' => $request->pen_po,
            'jumlah_training' => $request->jumlah_training,
            'qty_peserta' => $request->qty_peserta,
            'revenue' => $revenue,
        ]);
        return redirect()->back()->with('success', 'Data has been Added successfully.');
    }

    public function destroy($id)
    {
        $delete = Report::find($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Data has been Deleted successfully.');
    }

    public function pdf(Request $request)
    {
        $data = Report::all();

        $bulan = array_combine(range(1, 12), array_map(fn ($m) => str_pad($m, 2, '0', STR_PAD_LEFT), range(1, 12)));
        $dataPerBulan = [];
        $year = 2024;

        for ($month = 1; $month <= 12; $month++) {
            $dataPerBulan[$month] = \App\Models\Report::where('user_id', Auth::id())->whereYear('month', $year)
                ->whereMonth('month', $month)
                ->get();
        }

        for ($i = 1; $i <= 12; $i++) {
            ${'newClientCount' . str_pad(
                $i,
                2,
                '0',
                STR_PAD_LEFT
            )} = \App\Models\NewClientCall::where('user_id', Auth::id())->whereYear('date', $year)
                ->whereMonth('date', $bulan[$i])
                ->count();
        }


        for ($i = 1; $i <= 12; $i++) {
            ${'blastingEmail' . str_pad(
                $i,
                2,
                '0',
                STR_PAD_LEFT
            )} = \App\Models\bEmail::where('user_id', Auth::id())->whereYear('date', $year)
                ->whereMonth('date', $bulan[$i])
                ->count();
        }

        for ($i = 1; $i <= 12; $i++) {
            ${'blastingWhatsApp' . str_pad(
                $i,
                2,
                '0',
                STR_PAD_LEFT
            )} = \App\Models\bWhatshApp::where('user_id', Auth::id())->whereYear('date', $year)
                ->whereMonth('date', $bulan[$i])
                ->count();
        }

        for ($i = 1; $i <= 12; $i++) {
            ${'vistClient' . str_pad(
                $i,
                2,
                '0',
                STR_PAD_LEFT
            )} = \App\Models\Visit::where('user_id', Auth::id())->whereYear('date', $year)
                ->whereMonth('date', $bulan[$i])
                ->count();
        }


        for ($i = 1; $i <= 12; $i++) {
            $QL = \App\Models\QLSend::with('noQL')->where('user_id', Auth::id())
                ->get();

            // Menyimpan hasil dalam array
            $qlsERVER = [];

            foreach ($QL as $value) {
                // Mengambil jumlah data dari model Quotation berdasarkan id_penawaran
                $count = \App\Models\Quotation::where('id_penawaran', $value->no_ql_id)
                    ->whereYear('date_penawaran', $year)
                    ->whereMonth('date_penawaran', $bulan[$i])
                    ->count();

                // Menyimpan hasil ke array jika jumlahnya lebih dari 0
                if ($count > 0) {
                    $qlsERVER[] = [
                        'id_penawaran' => $value->no_ql_id,
                        'count' => $count
                    ];
                }
            }

            // Menyimpan total count untuk bulan yang sesuai
            ${"totalCount" . str_pad($i, 2, '0', STR_PAD_LEFT)} = array_sum(array_column(
                $qlsERVER,
                'count'
            ));
        }


        for ($i = 1; $i <= 12; $i++) {
            $jumlahTraining = \App\Models\reportOrder::where(
                'user_id',
                Auth::id()
            )->get();

            $jumlahTrainingSERVER = [];
            $sumTrainingSERVER = [];
            $dataPo = collect();
            $totalAmountPO = 0;

            foreach ($jumlahTraining as $value) {
                // Menghitung jumlah order
                $countTraining = \App\Models\Order::where('id_order', $value->order_id)
                    ->whereYear('tgl_order', $year)
                    ->whereMonth('tgl_order', $bulan[$i])
                    ->count();

                if ($countTraining > 0) {
                    $jumlahTrainingSERVER[] = [
                        'id_order' => $value->order_id,
                        'count' => $countTraining
                    ];
                }

                // Menghitung jumlah total order
                $sumTraining = \App\Models\Order::where('id_order', $value->order_id)
                    ->whereYear('tgl_order', $year)
                    ->whereMonth('tgl_order', $bulan[$i])
                    ->sum('jumlah_order');

                if ($sumTraining > 0) {
                    $sumTrainingSERVER[] = [
                        'id_order' => $value->order_id,
                        'count' => $sumTraining
                    ];
                }
            }

            // Menjumlahkan nilai 'count' dari setiap item dalam array $jumlahTrainingSERVER
            ${"totalCountJumlahTraining" . str_pad($i, 2, '0', STR_PAD_LEFT)} =
                array_sum(array_column(
                    $jumlahTrainingSERVER,
                    'count'
                ));

            // Menjumlahkan nilai 'count' dari setiap item dalam array $sumTrainingSERVER
            ${"totalSumJumlahTraining" . str_pad($i, 2, '0', STR_PAD_LEFT)} =
                array_sum(array_column(
                    $sumTrainingSERVER,
                    'count'
                ));

            // Ambil data PO untuk bulan yang sesuai
            $usData = \App\Models\reportOrder::where('user_id', Auth::id())
                ->whereYear('tgl_order', $year)
                ->whereMonth('tgl_order', $bulan[$i])
                ->get();

            foreach ($usData as $order) {
                if ($order->orderJan) {
                    $poItems = \App\Models\PO::where('ql_po', $order->orderJan->penawaran_order)
                        ->where('tgl_po', $order->orderJan->tgl_order)
                        ->get();

                    // Tambahkan hasil query ke dalam koleksi $dataPo
                    $dataPo = $dataPo->merge($poItems);


                    // Jumlahkan semua nilai 'amount_po'
                    $totalAmountPO += $poItems->sum('amount_po');
                    // dd($totalAmountPO);
                }
            }

            ${"totalAmountPO" . str_pad($i, 2, '0', STR_PAD_LEFT)} = $totalAmountPO;
        }


        $totalClientCalls = $dataPerBulan[7]->first()->client_call ?? 0;
        $dataPersen07 = ($totalClientCalls > 0) ? ($newClientCount07 /
            $totalClientCalls)
            *
            100 :
            0;

        $totalblastingEmails = $dataPerBulan[7]->first()->blasting_email ?? 0;
        $dataPersenEmail07 = ($totalblastingEmails > 0) ? ($blastingEmail07 /
            $totalblastingEmails)
            *
            100 : 0;

        $totalblastingWhatsApp07 = $dataPerBulan[7]->first()->blasting_whatsapp
            ??
            0;
        $dataPersenblastingWhatsApp07 = ($totalblastingWhatsApp07 > 0) ?
            ($blastingWhatsApp07 /
                $totalblastingWhatsApp07) * 100 : 0;

        $totalvistClient07 = $dataPerBulan[7]->first()->client_visit ?? 0;
        $dataPersenvistClient07 = ($totalvistClient07 > 0) ? ($vistClient07 /
            $totalvistClient07) * 100 : 0;

        $totalQL07 = $dataPerBulan[7]->first()->ql_send ?? 0;
        $dataPersenQL07 = ($totalQL07 > 0) ? ($totalCount07 /
            $totalQL07) * 100 : 0;

        $totaljudul = $dataPerBulan[7]->first()->pen_po ?? 0;
        $dataPersentotalPO07 = ($totaljudul > 0) ? ($totalCountJumlahTraining07
            /
            $totaljudul) * 100 : 0;

        $totaljudul = $dataPerBulan[7]->first()->jumlah_training ?? 0;
        $dataPersentotaljudul07 = ($totaljudul > 0) ?
            ($totalCountJumlahTraining07
                /
                $totaljudul) * 100 : 0;

        $totalsumQTY = $dataPerBulan[7]->first()->qty_peserta ?? 0;
        $dataPersentotalsumQTY07 = ($totalsumQTY > 0) ?
            ($totalSumJumlahTraining07
                /
                $totalsumQTY) * 100 : 0;


        $totalpoAMount = $dataPerBulan[7]->first()->revenue ?? 0;
        $dataPersentotalsumQTYPO07 = ($totalpoAMount > 0) ? ($totalAmountPO07 /
            $totalpoAMount) * 100 : 0;

        // dd($totalAmountPO07);


        $totalpersen07 = '0';

        // Daftar nilai yang ingin dijumlahkan
        $values = [
            $dataPersen07 ?? '0',
            $dataPersenEmail07 ?? '0',
            $dataPersenblastingWhatsApp07 ?? '0',
            $dataPersenvistClient07 ?? '0',
            $dataPersenQL07 ?? '0',
            $dataPersentotalPO07 ?? '0',
            $dataPersentotaljudul07 ?? '0',
            $dataPersentotalsumQTY07 ?? '0',
            $dataPersentotalsumQTYPO07 ?? '0',
        ];

        // Jumlahkan semua nilai menggunakan bcadd
        foreach ($values as $value) {
            $totalpersen07 = bcadd($totalpersen07, $value); // 2 adalah jumlah digit desimal
        }

        $averagePersen07 = number_format($totalpersen07 / 9, 0);
        foreach ($dataPerBulan[7] as $item) {
            $item->update(['persentase' => $averagePersen07]);
        }


        $totalClientCalls = $dataPerBulan[8]->first()->client_call ?? 0;
        $dataPersen08 = ($totalClientCalls > 0) ? ($newClientCount08 /
            $totalClientCalls)
            *
            100 :
            0;

        $totalblastingEmails = $dataPerBulan[8]->first()->blasting_email ?? 0;
        $dataPersenEmail08 = ($totalblastingEmails > 0) ? ($blastingEmail08 /
            $totalblastingEmails)
            *
            100 : 0;

        $totalblastingWhatsApp08 = $dataPerBulan[8]->first()->blasting_whatsapp
            ??
            0;
        $dataPersenblastingWhatsApp08 = ($totalblastingWhatsApp08 > 0) ?
            ($blastingWhatsApp08 /
                $totalblastingWhatsApp08) * 100 : 0;

        $totalvistClient08 = $dataPerBulan[8]->first()->client_visit ?? 0;
        $dataPersenvistClient08 = ($totalvistClient08 > 0) ? ($vistClient08 /
            $totalvistClient08) * 100 : 0;

        $totalQL08 = $dataPerBulan[8]->first()->ql_send ?? 0;
        $dataPersenQL08 = ($totalQL08 > 0) ? ($totalCount08 /
            $totalQL08) * 100 : 0;

        $totaljudul = $dataPerBulan[8]->first()->pen_po ?? 0;
        $dataPersentotalPO08 = ($totaljudul > 0) ? ($totalCountJumlahTraining08
            /
            $totaljudul) * 100 : 0;

        $totaljudul = $dataPerBulan[8]->first()->jumlah_training ?? 0;
        $dataPersentotaljudul08 = ($totaljudul > 0) ?
            ($totalCountJumlahTraining08
                /
                $totaljudul) * 100 : 0;

        $totalsumQTY = $dataPerBulan[8]->first()->qty_peserta ?? 0;
        $dataPersentotalsumQTY08 = ($totalsumQTY > 0) ?
            ($totalSumJumlahTraining08
                /
                $totalsumQTY) * 100 : 0;


        $totalpoAMount = $dataPerBulan[8]->first()->revenue ?? 0;
        $dataPersentotalsumQTYPO08 = ($totalpoAMount > 0) ? ($totalAmountPO08 /
            $totalpoAMount) * 100 : 0;

        // dd($totalAmountPO08);


        $totalpersen08 = '0';

        // Daftar nilai yang ingin dijumlahkan
        $values = [
            $dataPersen08 ?? '0',
            $dataPersenEmail08 ?? '0',
            $dataPersenblastingWhatsApp08 ?? '0',
            $dataPersenvistClient08 ?? '0',
            $dataPersenQL08 ?? '0',
            $dataPersentotalPO08 ?? '0',
            $dataPersentotaljudul08 ?? '0',
            $dataPersentotalsumQTY08 ?? '0',
            $dataPersentotalsumQTYPO08 ?? '0',
        ];

        // Jumlahkan semua nilai menggunakan bcadd
        foreach ($values as $value) {
            $totalpersen08 = bcadd($totalpersen08, $value); // 2 adalah jumlah digit desimal
        }

        $averagePersen08 = number_format($totalpersen08 / 9, 0);
        foreach ($dataPerBulan[8] as $item) {
            $item->update(['persentase' => $averagePersen08]);
        }

        $pdf = PDF::loadview('pages.report.pdf', [
            'data' => $data,
            'dataPerBulan' => $dataPerBulan,
            'newClientCount07' => $newClientCount07,
            'blastingEmail07' => $blastingEmail07,
            'blastingWhatsApp07' => $blastingWhatsApp07,
            'vistClient07' => $vistClient07,
            'totalCount07' => $totalCount07,
            'totalCountJumlahTraining07' => $totalCountJumlahTraining07,
            'totalSumJumlahTraining07' => $totalSumJumlahTraining07,
            'totalAmountPO07' => $totalAmountPO07,

            'newClientCount08' => $newClientCount08,
            'blastingEmail08' => $blastingEmail08,
            'blastingWhatsApp08' => $blastingWhatsApp08,
            'vistClient08' => $vistClient08,
            'totalCount08' => $totalCount08,
            'totalCountJumlahTraining08' => $totalCountJumlahTraining08,
            'totalSumJumlahTraining08' => $totalSumJumlahTraining08,
            'totalAmountPO08' => $totalAmountPO08,

        ]);

        return $pdf->stream('LAPORAN-KERJA-MARKETING.pdf');
    }


    public function edit($id)
    {
        // dd($id);
        $edit = Report::find($id);
        $user = User::whereNotIn('id', [1])->get();
        $data = Report::all();
        return view('pages.report.index', [
            'edit' => $edit,
            'user' => $user,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $edit = Report::find($id);
        $revenue = $request->revenue;
        $revenue = str_replace(['.', ','], '', $revenue ?? '0');
        $dateMont = $request->month . '-01';
        $edit->update([
            'month' => $dateMont,
            'client_call' => $request->client_call,
            'blasting_email' => $request->blasting_email,
            'blasting_whatsapp' => $request->blasting_whatsapp,
            'client_visit' => $request->client_visit,
            'ql_send' => $request->ql_send,
            'pen_po' => $request->pen_po,
            'jumlah_training' => $request->jumlah_training,
            'qty_peserta' => $request->qty_peserta,
            'revenue' => $revenue,
        ]);

        return redirect()->route('report.index')->with('success', 'Data has been Updated successfully.');
    }
}
