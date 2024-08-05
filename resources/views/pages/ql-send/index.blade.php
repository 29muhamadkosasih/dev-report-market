@extends('layouts/master')

@section('title', 'Qoutation Send')

@section('content')
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Data Qoutation Send</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered dataex-fixh-responsive">
                    <thead>
                        <tr style="background-color: skyblue">
                            <th width='10px' style="text-align: center">No</th>
                            <th width='80px'>No QL</th>
                            <th width='80px'>QL Date</th>
                            <th>Nama Client</th>
                            <th>Sertifikasi</th>
                            <th>Judul Training</th>
                            <th>Status</th>
                            @if (Auth::user()->role_id == 1)
                            <th>PIC</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $dataCollection = (Auth::user()->role_id == 1) ? $data : $usData;
                        @endphp
                        @foreach ($dataCollection as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->noQL->no_penawaran }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->noQL->date_penawaran)->format('Y-m-d') }}
                            </td>
                            <td>{{ $item->noQL->client->nama_klien }}</td>
                            <td>{{ $item->noQL->judulTraining->sertifikasi->nama_paket }}</td>
                            <td>{{ $item->noQL->judulTraining->nama_judul }}</td>
                            <td>{{ $item->noQL->status_penawaran }}</td>
                            @if (Auth::user()->role_id == 1)
                            <td>
                                @if ($item->user_id == null)
                                @else
                                {{ explode(' ', $item->user->name)[0] }}

                                @endif
                            </td>
                            @endif
                            {{-- <td style="text-align: center">
                                <form method="POST" action="{{ route('quotation-letter.destroy', $item->id) }}">
                                    @csrf
                                    @can('quotation-letter.delete')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-icon btn-danger btn-sm show_confirm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete"
                                        aria-describedby="tooltip358783">
                                        <span class="ti ti-trash"></span>
                                    </button>
                                    @endcan
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

</script>

@endsection
