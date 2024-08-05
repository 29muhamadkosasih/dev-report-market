@extends('layouts/master')
@section('title', 'Report')

@section('content')
@if (isset($edit))
<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Edit Data</h5>
                </div>
                <div class="card-body">
                    @include('pages.report.edit')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif

@can('report.admin')
<div class="col-12 mb-3">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Reporting Kinerja </h5>
                </div>
                <div class="col-auto">

                    @php
                    // Ambil data berdasarkan user_id
                    $datawq = \App\Models\reportOrder::where('user_id', Auth::id())->get();
                    @endphp

                    {{-- Debugging, sebaiknya dihapus sebelum deploy --}}
                    {{-- @dd($datawq) --}}

                    {{-- Cek jika $datawq tidak kosong --}}
                    @if ($datawq->isNotEmpty())
                    @endif

                    <a data-bs-toggle="modal" data-bs-target="#modalKP" class="btn btn-primary" style="color: white">
                        Create
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table  table-bordered dataex-fixh-responsive">
                    <thead>
                        <tr style="background-color: skyblue">
                            <th>Month</th>
                            <th>Nama</th>
                            <th>NEW CLIENT CALL</th>
                            <th>BLASTING EMAIL</th>
                            <th>BROADCAST WA</th>
                            <th>CLIENT VISIT</th>
                            <th>QL TERKIRIM</th>
                            <th>PENERIMAAN PO</th>
                            <th>JUMLAH TRAINING</th>
                            <th>QTY PESERTA TRAINING</th>
                            <th>REVENUE (RP)</th>
                            <th width='50px' class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->month)->format('m-Y') }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->client_call }}</td>
                            <td>{{ $item->blasting_email }}</td>
                            <td>{{ $item->blasting_whatsapp }}</td>
                            <td>{{ $item->client_visit }}</td>
                            <td>{{ $item->ql_send }}</td>
                            <td>{{ $item->pen_po }}</td>
                            <td>{{ $item->jumlah_training }}</td>
                            <td>{{ $item->qty_peserta }}</td>
                            <td>
                                {{ number_format($item->revenue, 2, ',', '.')?? 0 }}
                            </td>
                            <td style="text-align: center">
                                <form method="POST" action="{{ route('report.destroy', $item->id) }}">
                                    @csrf
                                    @can('report.edit')
                                    <a href="{{ route('report.edit', $item->id) }}"
                                        class="btn btn-icon btn-warning btn-sm">
                                        <span class="ti ti-edit"></span>
                                    </a>
                                    @endcan

                                    @can('report.delete')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-icon btn-danger btn-sm show_confirm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete"
                                        aria-describedby="tooltip358783">
                                        <span class="ti ti-trash"></span>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endcan


@php
$cekadaga =\App\Models\Report::where('user_id', Auth::id())->get();
@endphp

@if (Auth::user()->role_id != 1)
<div class="col-12" id="text-kecil">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Reporting Kinerja - {{ Auth::user()->name }} </h5>
                </div>
                <div class="col-auto">
                    @php
                    // Ambil data berdasarkan user_id
                    $datawq = \App\Models\Report::where('user_id', Auth::id())->get();
                    @endphp

                    {{-- Debugging, sebaiknya dihapus sebelum deploy --}}
                    {{-- @dd($datawq) --}}

                    {{-- Cek jika $datawq tidak kosong --}}
                    @if ($datawq->isNotEmpty())
                    <a href="{{ url('report/pdf') }}" class="btn btn-secondary" target="_blank" style="color: white">
                        PDF
                    </a>
                    @endif
                </div>
            </div>
            @php
            $bulan = array_combine(range(1, 12), array_map(fn($m) => str_pad($m, 2, '0', STR_PAD_LEFT), range(1, 12)));
            $dataPerBulan = [];
            $year = 2024;

            for ($month = 1; $month <= 12; $month++) { $dataPerBulan[$month]=\App\Models\Report::where('user_id',
                Auth::id()) ->
                whereYear('month', $year)
                ->whereMonth('month', $month)
                ->get();
                }

                $newClientCount07 = \App\Models\NewClientCall::where('user_id', Auth::id())
                ->whereYear('date', $year)
                ->whereMonth('date', $bulan[7])
                ->count();
                @endphp


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr style="background-color: skyblue">
                            <th rowspan="3">BULAN</th>
                            <th colspan="3">NEW CLIENT CALL</th>
                            <th colspan="3">BLASTING EMAIL</th>
                            <th colspan="3">BROADCAST WA</th>
                            <th colspan="3">CLIENT VISIT</th>
                            <th colspan="3">QL TERKIRIM</th>
                            <th colspan="3">PENERIMAAN PO</th>
                            <th colspan="3">JUMLAH TRAINING</th>
                            <th colspan="3">QTY PESERTA TRAINING</th>
                            <th colspan="3">REVENUE (RP)</th>
                            <th>RESUME</th>
                        </tr>
                        {{-- <tr style="background-color: skyblue">
                            <th colspan="3">{{ $dataPerBulan[7]->first()->client_call ?? 0}} Client/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->blasting_email ?? 0}} Blasting/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->blasting_whatsapp ?? 0}} Broadcast/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->client_visit ?? 0}} Visit/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->ql_send ?? 0}} QL/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->pen_po ?? 0}} PO/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->jumlah_training ?? 0}} Training/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->qty_peserta ?? 0}} Peserta/Minggu</th>
                            <th colspan="3">{{ $dataPerBulan[7]->first()->revenue ?? 0}} /Minggu</th>
                            <th>PENCAPAIAN</th>
                        </tr>
                        <tr style="background-color: skyblue">
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th>TARGET</th>
                            <th>REALITAS</th>
                            <th>%</th>
                            <th> %</th>
                        </tr>
                        </thead>
                        <tbody> --}}
                            {{-- <tr>
                                <td>Juli</td>
                                <td>
                                    @if ($newClientCount07)
                                    {{ $dataPerBulan[7]->first()->client_call }}
                                    @endif
                                </td>
                                <td>
                                    @if ($newClientCount07)
                                    {{ $newClientCount07 }}
                                    @endif
                                </td>
                                <td>

                                    @if ($newClientCount07)
                                    @php
                                    $dataPersen7 = $newClientCount07 / $dataPerBulan[7]->first()->client_call * 100;
                                    @endphp
                                    {{ number_format($dataPersen7, 0) }}%
                                    @endif

                                </td>
                                <td>8</td>
                                <td>0</td>
                                <td>0%</td>
                                <td>8</td>
                                <td>0</td>
                                <td>0%</td>
                                <td>4</td>
                                <td>0</td>
                                <td>0%</td>
                                <td>32</td>
                                <td>0</td>
                                <td>0%</td>
                                <td>12</td>
                                <td>0</td>
                                <td>0%</td>
                                <td>12</td>
                                <td>0</td>
                                <td>0%</td>
                                <td>60</td>
                                <td>0</td>
                                <td>0%</td>
                                <td> 120.000.000 </td>
                                <td> - </td>
                                <td>0%</td>
                                <td>0%</td>
                            </tr> --}}
                    </table>
                </div>
        </div>
    </div>
</div>
@endif



<div class="modal fade" id="modalKP" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambakan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md-12">
                            <label for="user_id">Name</label>
                            <select name="user_id" id="user_id" class="form-select select2" required>
                                <option value="">Open this select</option>
                                @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Month</label>
                            <input type="month" class="form-control" placeholder="Enter" name="month" required>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">New Client Call</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="client_call"
                                    required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Blasting Email</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="blasting_email"
                                    required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Blasting WhatsApp</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="blasting_whatsapp"
                                    required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Client Visit</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="client_visit"
                                    required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">QL Terkirim</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="ql_send" required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Penerimaan PO</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="pen_po" required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Jumlah Training</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="jumlah_training"
                                    required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Qty Jumlah Peserta</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Enter" name="qty_peserta"
                                    required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="order_id">Revenue (Rp.)</label>
                            <div class="input-group">
                                <input type="text" class="form-control unit-price-input" placeholder="Enter"
                                    name="revenue" required>
                                <span class="input-group-text">Week</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

      // Format Rupiah function
        function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
        }


        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        // Format unit price
                $(document).on('keyup', '.unit-price-input', function () {
                this.value = formatRupiah(this.value);
                });

</script>
@endsection
