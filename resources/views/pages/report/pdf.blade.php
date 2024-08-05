<!DOCTYPE html>

<head>
    <title>LAPORAN KERJA MARKETING</title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: 'DejaVuSans', sans-serif;
            font-size: 10px;
            margin: 0;
            margin-bottom: 0px;
        }

        #judul {
            text-align: left;
            font-family: sans-serif;
        }

        #ping {
            border-spacing: 0px;
            border-collapse: separate;
            border: 1px solid black;
        }

        @page {
            size: A4 landscape;
            margin: 13px;
        }

        th,
        td {
            padding-left: 5px;
            padding-right: 5px;
        }
    </style>
</head>

<body>
    <div id="halaman">
        <h3 style="text-align: center"><b>
                LAPORAN KERJA MARKETING</b>
            <br>
            <b>{{ Auth::user()->name }}</b>

        </h3>
    </div>
    <table class="table" border="1" id="ping">
        <thead>
            <tr style="background-color: yellow">
                <th rowspan="3">BULAN</th>
                <th colspan="3" rowspan="2">NEW CLIENT CALL </th>
                <th colspan="3" rowspan="2">BLASTING <br> EMAIL</th>
                <th colspan="3" rowspan="2">BROADCAST <br> WA</th>
                <th colspan="3" rowspan="2">CLIENT <br> VISIT</th>
                <th colspan="3" rowspan="2">QL <br> TERKIRIM</th>
                <th colspan="3" rowspan="2">PENERIMAAN PO</th>
                <th colspan="3" rowspan="2">JUMLAH <br> TRAINING</th>
                <th colspan="3" rowspan="2">QTY PESERTA <br> TRAINING</th>
                <th colspan="3" rowspan="2">REVENUE (RP)</th>
                <th rowspan="2">RESUME <br> PENCAPAIAN</th>
            </tr>
            <tr>
            </tr>
            <tr style="background-color: antiquewhite">
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px">T</th>
                <th style="width: 20px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 64px">T</th>
                <th style="width: 64px">R</th>
                <th style="width: 20px">%</th>
                <th style="width: 20px"> %</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">Juli</td>
                {{-- new client call --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->client_call ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $newClientCount07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalClientCalls = $dataPerBulan[7]->first()->client_call ?? 0;
                    $dataPersen07 = ($totalClientCalls > 0) ? ($newClientCount07 /
                    $totalClientCalls)
                    *
                    100 :
                    0;
                    @endphp
                    {{ number_format($dataPersen07, 0) }}%

                </td>
                {{-- end new client call --}}

                {{-- blasting Email --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->blasting_email ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $blastingEmail07 ?? 0 }}
                </td>
                <td style="text-align: center">

                    @php
                    $totalblastingEmails = $dataPerBulan[7]->first()->blasting_email ?? 0;
                    $dataPersenEmail07 = ($totalblastingEmails > 0) ? ($blastingEmail07 /
                    $totalblastingEmails)
                    *
                    100 : 0;
                    @endphp
                    {{ number_format($dataPersenEmail07, 0) }}%
                </td>
                {{-- end blasting Email --}}

                {{-- blasting WA --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->blasting_whatsapp ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $blastingWhatsApp07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalblastingWhatsApp07 = $dataPerBulan[7]->first()->blasting_whatsapp
                    ??
                    0;
                    $dataPersenblastingWhatsApp07 = ($totalblastingWhatsApp07 > 0) ?
                    ($blastingWhatsApp07 /
                    $totalblastingWhatsApp07) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersenblastingWhatsApp07, 0) }}%

                </td>
                {{-- End blasting wa --}}

                {{-- visit client --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->client_visit ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $vistClient07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalvistClient07 = $dataPerBulan[7]->first()->client_visit ?? 0;
                    $dataPersenvistClient07 = ($totalvistClient07 > 0) ? ($vistClient07 /
                    $totalvistClient07) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersenvistClient07, 0) }}%

                </td>
                {{-- end visit client --}}

                {{-- QL SEND --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->ql_send ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalCount07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalQL07 = $dataPerBulan[7]->first()->ql_send ?? 0;
                    $dataPersenQL07 = ($totalQL07 > 0) ? ($totalCount07 /
                    $totalQL07) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersenQL07, 0) }}%

                </td>
                {{-- END QL SEND --}}


                {{-- po --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->pen_po ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalCountJumlahTraining07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totaljudul = $dataPerBulan[7]->first()->pen_po ?? 0;
                    $dataPersentotalPO07 = ($totaljudul > 0) ? ($totalCountJumlahTraining07
                    /
                    $totaljudul) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotalPO07, 0) }}%

                </td>
                {{-- end po --}}

                {{-- jumlah training --}}

                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->jumlah_training ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalCountJumlahTraining07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totaljudul = $dataPerBulan[7]->first()->jumlah_training ?? 0;
                    $dataPersentotaljudul07 = ($totaljudul > 0) ?
                    ($totalCountJumlahTraining07
                    /
                    $totaljudul) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotaljudul07, 0) }}%

                </td>
                {{-- end jumlah training --}}

                {{-- jumlah peserta --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[7]->first()->qty_peserta ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalSumJumlahTraining07 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalsumQTY = $dataPerBulan[7]->first()->qty_peserta ?? 0;
                    $dataPersentotalsumQTY07 = ($totalsumQTY > 0) ?
                    ($totalSumJumlahTraining07
                    /
                    $totalsumQTY) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotalsumQTY07, 0) }}%

                </td>
                {{-- jumlah peserta --}}


                {{-- revenue --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ number_format($dataPerBulan[7]->first()->revenue, 0, ',', '.')?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ number_format($totalAmountPO07, 0, ',', '.')?? 0 }}
                </td>
                <td style="text-align: center">

                    @php
                    $totalpoAMount = $dataPerBulan[7]->first()->revenue ?? 0;
                    $dataPersentotalsumQTYPO07 = ($totalpoAMount > 0) ? ($totalAmountPO07 /
                    $totalpoAMount) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotalsumQTYPO07, 0) }}%

                </td>
                {{-- end revenue --}}

                <td style="text-align: center">
                    @php

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
                    @endphp

                    {{ number_format($totalpersen07 / 9, 0) }}%
                </td>
            </tr>

            <tr>
                <td style="text-align: center">Agustus</td>
                {{-- new client call --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->client_call ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $newClientCount08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalClientCalls08 = $dataPerBulan[7]->first()->client_call ?? 0;
                    $dataPersen08 = ($totalClientCalls08 > 0) ? ($newClientCount08 /
                    $totalClientCalls08) *
                    100
                    : 0;
                    @endphp
                    {{ number_format($dataPersen08, 0) }}%

                </td>
                {{-- end new client call --}}

                {{-- blasting Email --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->blasting_email ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $blastingEmail08 ?? 0 }}
                </td>
                <td style="text-align: center">

                    @php
                    $totalblastingEmails = $dataPerBulan[8]->first()->blasting_email ?? 0;
                    $dataPersenEmail08 = ($totalblastingEmails > 0) ? ($blastingEmail08 /
                    $totalblastingEmails)
                    *
                    100 : 0;
                    @endphp
                    {{ number_format($dataPersenEmail08, 0) }}%
                </td>
                {{-- end blasting Email --}}

                {{-- blasting WA --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->blasting_whatsapp ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $blastingWhatsApp08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalblastingWhatsApp08 = $dataPerBulan[8]->first()->blasting_whatsapp
                    ??
                    0;
                    $dataPersenblastingWhatsApp08 = ($totalblastingWhatsApp08 > 0) ?
                    ($blastingWhatsApp08 /
                    $totalblastingWhatsApp08) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersenblastingWhatsApp08, 0) }}%

                </td>
                {{-- End blasting wa --}}

                {{-- visit client --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->client_visit ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $vistClient08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalvistClient08 = $dataPerBulan[8]->first()->client_visit ?? 0;
                    $dataPersenvistClient08 = ($totalvistClient08 > 0) ? ($vistClient08 /
                    $totalvistClient08) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersenvistClient08, 0) }}%

                </td>
                {{-- end visit client --}}

                {{-- QL SEND --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->ql_send ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalCount08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalQL08 = $dataPerBulan[8]->first()->ql_send ?? 0;
                    $dataPersenQL08 = ($totalQL08 > 0) ? ($totalCount08 /
                    $totalQL08) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersenQL08, 0) }}%

                </td>
                {{-- END QL SEND --}}


                {{-- po --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->pen_po ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalCountJumlahTraining08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totaljudul08 = $dataPerBulan[8]->first()->pen_po ?? 0;
                    $dataPersentotalPO8 = ($totaljudul08 > 0) ? ($totalCountJumlahTraining08
                    /
                    $totaljudul08) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotalPO8, 0) }}%

                </td>
                {{-- end po --}}

                {{-- jumlah training --}}

                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->jumlah_training ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalCountJumlahTraining08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totaljudul08 = $dataPerBulan[8]->first()->jumlah_training ?? 0;
                    $dataPersentotaljudul08 = ($totaljudul08 > 0) ?
                    ($totalCountJumlahTraining08 / $totaljudul08) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotaljudul08, 0) }}%

                </td>
                {{-- end jumlah training --}}

                {{-- jumlah peserta --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    {{ $dataPerBulan[8]->first()->qty_peserta ?? 0 }}
                </td>
                <td style="text-align: center">
                    {{ $totalSumJumlahTraining08 ?? 0 }}
                </td>
                <td style="text-align: center">
                    @php
                    $totalsumQTY = $dataPerBulan[8]->first()->qty_peserta ?? 0;
                    $dataPersentotalsumQTY08 = ($totalsumQTY > 0) ?
                    ($totalSumJumlahTraining08 /
                    $totalsumQTY) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotalsumQTY08, 0) }}%

                </td>
                {{-- jumlah peserta --}}


                {{-- revenue --}}
                <td style="text-align: center;;background-color:rgb(23, 208, 23)">
                    @php
                    $firstData = $dataPerBulan[8]->first();
                    $revenue = $firstData ? $firstData->revenue : 0;
                    @endphp
                    {{ number_format($revenue, 0, ',', '.') }}

                </td>
                <td style="text-align: center">
                    {{ number_format($totalAmountPO08, 0, ',', '.')?? 0 }}
                </td>
                <td style="text-align: center">

                    @php
                    $totalpoAMount = $dataPerBulan[8]->first()->revenue ?? 0;
                    $dataPersentotalsumQTYPO08 = ($totalpoAMount > 0) ? ($totalAmountPO08 /
                    $totalpoAMount) * 100 : 0;
                    @endphp
                    {{ number_format($dataPersentotalsumQTYPO08, 0) }}%

                </td>
                {{-- end revenue --}}

                <td style="text-align: center">

                    @php

                    $totalClientCalls08 = $dataPerBulan[8]->first()->client_call ?? 0;
                    $dataPersen08 = ($totalClientCalls08 > 0) ? ($newClientCount08 /
                    $totalClientCalls08) *
                    100
                    : 0;

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

                    $totaljudul08 = $dataPerBulan[8]->first()->pen_po ?? 0;
                    $dataPersentotalPO8 = ($totaljudul08 > 0) ? ($totalCountJumlahTraining08
                    /
                    $totaljudul08) * 100 : 0;

                    $totaljudul08 = $dataPerBulan[8]->first()->jumlah_training ?? 0;
                    $dataPersentotaljudul08 = ($totaljudul > 0) ?
                    ($totalCountJumlahTraining08
                    /
                    $totaljudul08) * 100 : 0;

                    $totalsumQTY = $dataPerBulan[8]->first()->qty_peserta ?? 0;
                    $dataPersentotalsumQTY08 = ($totalsumQTY > 0) ?
                    ($totalSumJumlahTraining08 /
                    $totalsumQTY) * 100 : 0;

                    $totalpoAMount = $dataPerBulan[8]->first()->revenue ?? 0;
                    $dataPersentotalsumQTYPO08 = ($totalpoAMount > 0) ? ($totalAmountPO08 /
                    $totalpoAMount) * 100 : 0;


                    $totald08 = '0';

                    // Daftar nilai yang ingin dijumlahkan
                    $values = [
                    $dataPersen08 ?? '0',
                    $dataPersenEmail08 ?? '0',
                    $dataPersenblastingWhatsApp08 ?? '0',
                    $dataPersenvistClient08 ?? '0',
                    $dataPersenQL08 ?? '0',
                    $dataPersentotalPO8 ?? '0',
                    $dataPersentotaljudul08 ?? '0',
                    $dataPersentotalsumQTY08 ?? '0',
                    $dataPersentotalsumQTYPO08 ?? '0',
                    ];

                    // Jumlahkan semua nilai menggunakan bcadd
                    foreach ($values as $value) {
                    $totald08 = bcadd($totald08, $value); // 2 adalah jumlah digit desimal
                    }
                    @endphp

                    {{ number_format($totald08 / 9, 0) }}%

                </td>
            </tr>

        </tbody>
    </table>
</body>


</html>
