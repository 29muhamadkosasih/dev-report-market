@php

    $QL01 = \App\Models\QLSend::with('noQL')
    ->where('user_id', Auth::id())
    ->get();

    // Menyimpan hasil dalam array
    $qlsERVER01 = [];

    foreach ($QL01 as $value) {
    // Mengambil jumlah data dari model Quotation berdasarkan id_penawaran
    $count = \App\Models\Quotation::where('id_penawaran', $value->no_ql_id)
    ->whereYear('date_penawaran', $year)
    ->whereMonth('date_penawaran', $bulan[1])
    ->count();

    // Menyimpan hasil ke array jika jumlahnya lebih dari 0
    if ($count > 0) {
    $qlsERVER01[] = [
    'id_penawaran' => $value->no_ql_id,
    'count' => $count
    ];
    }
    }
    $totalCount01 = array_sum(array_column($qlsERVER01, 'count'));
@endphp
