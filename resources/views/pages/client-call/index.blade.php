@extends('layouts/master')
@section('title', 'New Client Call')
@section('content')
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Data New Client Call</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered dataex-fixh-responsive">
                    <thead>
                        <tr style="background-color: skyblue">
                            <th width='10px' style="text-align: center">No</th>
                            <th width='80px'>Call/POST Date</th>
                            <th>Nama Perusahaan</th>
                            <th>Alamat </th>
                            <th>No Telf</th>
                            <th>Email</th>
                            <th>PIC Client</th>
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
                            <td>
                                {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                            </td>
                            <td>{{ $item->client->nama_klien }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->client->alamat_klien, 100) }}</td>
                            <td>
                                <ul>
                                    <li>{{ $item->client->kontak_klien }}</li>
                                    <li>{{ $item->client->hp_klien }}</li>
                                </ul>
                            </td>
                            <td>
                                @php
                                $emails = explode(',', $item->client->email_klien);
                                @endphp
                                <ul>
                                    @foreach ($emails as $email)
                                    <li>{{ trim($email) }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $item->client->pic_klien }}</td>
                            <td>{{ $item->client->status_klien }}</td>
                            @if (Auth::user()->role_id == 1)
                            <td>
                                @if ($item->user_id)
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
