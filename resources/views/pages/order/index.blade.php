@extends('layouts/master')

@section('title', 'Orders')

@section('content')
<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Data Report Order</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered dataex-fixh-responsive">
                    <thead>
                        <tr style="background-color: skyblue">
                            <th width='10px' style="text-align: center">No</th>
                            <th width='80px'>Order Date</th>
                            <th>No Project Order</th>
                            <th>No Ql</th>
                            <th>Nama Client</th>
                            <th>Sertifikasi</th>
                            <th>Judul Training</th>
                            <th>Jumlah Peserta</th>
                            <th>Amount Rp.</th>
                            @if (Auth::user()->role_id == 1)
                            <th>PIC</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $dataCollection = (Auth::user()->role_id == 1) ? $datas : $usData;
                        @endphp
                        @foreach ($dataCollection as $item)

                        @php
                        // Ambil semua hasil yang cocok dengan 'ql_po'
                        $dataPo = \App\Models\PO::where('ql_po', $item->orderJan->penawaran_order)
                        ->where('tgl_po', $item->orderJan->tgl_order)
                        ->get();
                        // Jumlahkan semua nilai 'amount_po'
                        $totalAmount = $dataPo->sum('amount_po');
                        @endphp


                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->orderJan->tgl_order)->format('d-m-Y') }}
                            </td>
                            <td>


                                {{-- @dd($item->orderjan) --}}
                                {{ $item->orderjan->no_order }}

                            </td>
                            <td>{{ $item->orderJan->ql->no_penawaran }}</td>
                            <td>
                                @if ($item->order && $item->order->ql && $item->order->ql->client)
                                {{ $item->order->ql->client->nama_klien }}
                                @else
                                N/A
                                <!-- Atau pesan alternatif jika data tidak tersedia -->
                                @endif
                            </td>

                            <td>
                                @if ($item->order && $item->order->ql && $item->order->ql->client)
                                {{ $item->order->ql->judulTraining->sertifikasi->nama_paket }}
                                @else
                                N/A
                                <!-- Atau pesan alternatif jika data tidak tersedia -->
                                @endif
                            </td>

                            <td>
                                @if ($item->order && $item->order->ql && $item->order->ql->client)
                                {{ $item->order->ql->judulTraining->nama_judul }}
                                @else
                                N/A
                                <!-- Atau pesan alternatif jika data tidak tersedia -->
                                @endif
                            </td>

                            <td>
                                @if ($item->order && $item->order->ql && $item->order->ql->client)
                                {{ $item->orderJan->jumlah_order }}
                                @else
                                N/A
                                <!-- Atau pesan alternatif jika data tidak tersedia -->
                                @endif
                            </td>

                            <td>
                                {{ number_format($totalAmount, 2, ',', '.')?? 0 }}

                            </td>


                            @if (Auth::user()->role_id == 1)
                            <td>
                                @if ($item->user_id == null)
                                @else
                                {{ explode(' ', $item->user->name)[0] }}

                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKP" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambakan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md-12">
                            <label for="order_id">No. Project</label>
                            <select name="order_id" id="order_id" class="form-select select2" required>
                                <option value="">Open this select</option>
                                @foreach ($data as $item)
                                <option value="{{ $item->no_order }}">{{ $item->no_order }}
                                </option>
                                @endforeach
                            </select>
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

<!-- jQuery and Bootstrap JS -->
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