@extends('layouts/master')

@section('title', 'Visit Client')

@section('content')
<!-- Invoice table -->
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Visit Client</h5>
                </div>
                <div class="col-auto">
                    <a href="{{ route('visit.create') }}" class="btn btn-primary" style="color: white">
                        Create
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table  table-bordered dataex-fixh-responsive">
                    <thead>
                        <tr style="background-color: skyblue">
                            <th width='10px' style="text-align: center">No</th>
                            <th>Nama Client</th>
                            <th>Lokasi</th>
                            <th>Tanggal Visit</th>
                            <th>Agenda</th>
                            <th>Nama Visitor</th>
                            <th>Hasil <br>Pertemuan</th>
                            <th>Follow Up</th>
                            @if (Auth::user()->role_id == 1)
                            <th>PIC</th>
                            @endif <th width='50px' class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $dataCollection = (Auth::user()->role_id == 1) ? $data : $usData;
                        @endphp
                        @foreach ($dataCollection as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->client->nama_klien }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->agenda }}</td>
                            <td>

                                @php
                                $visitorIds = \App\Models\Visitors::where('vi_number', $item->vi_number)
                                ->get();
                                @endphp

                                <ul>
                                    @foreach ($visitorIds as $data)
                                    <li>{{ $data->karyawan->name }}</li>
                                    @endforeach
                                </ul>

                            </td>
                            <td>{{ $item->result }}</td>
                            <td>


                                <ul>
                                    <li>{{ $item->fo_1 }}</li>
                                    @if ($item->fo_2)
                                    <li>{{ $item->fo_2 }}</li>
                                    @endif

                                    @if ($item->fo_3)
                                    <li>{{ $item->fo_3 }}</li>
                                    @endif
                                </ul>

                            </td>
                            @if (Auth::user()->role_id == 1)
                            <td>
                                @if ($item->user_id == null)
                                @else
                                {{ explode(' ', $item->user->name)[0] }}

                                @endif
                            </td>
                            @endif
                            <td style="text-align: center">
                                <form method="POST" action="{{ route('visit.destroy', $item->id) }}">
                                    @csrf
                                    @can('visit.edit')
                                    <a href="{{ route('visit.edit', $item->id) }}"
                                        class="btn btn-icon btn-warning btn-sm">
                                        <span class="ti ti-edit"></span>
                                    </a>
                                    @endcan

                                    @can('visit.delete')
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