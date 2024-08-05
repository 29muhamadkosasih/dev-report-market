@extends('layouts/master')

@section('title', 'New Requests and Coordination')

@section('content')
<!-- Invoice table -->

<div class="col-xs-4 col-sm-4 col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    @if (isset($edit))
                    <h5 class="mb-0">Edit New Requests and Coordination</h5>
                    @else
                    <h5 class="mb-0">Tambah New Requests and Coordination</h5>
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($edit))
                    @include('pages.coordination.edit')
                    @else
                    @include('pages.coordination.create')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-8 col-sm-8 col-md-8">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-auto me-auto ">
                    <h5 class="mb-0">Data New Requests and Coordination</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered dataex-fixh-responsive">
                    <thead>
                        <tr style="background-color: skyblue">
                            <th width='10px' style="text-align: center">No</th>
                            <th width='80px'> Date</th>
                            <th>Dept/BU</th>
                            <th>DARI (Perusahaan)</th>
                            <th>Permintaan</th>
                            <th>PIC</th>
                            <th width='50px' class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                            </td>
                            <td>{{ $item->dept }}</td>
                            <td>

                                @if ($item->type_client === 'Existing')
                                @if ($item->client)
                                <!-- Memeriksa jika $item->client bukan null atau tidak kosong -->
                                {{ $item->namaKlien->nama_klien }}
                                @else
                                <!-- Jika $item->client tidak didefinisikan atau kosong, tampilkan pesan alternatif -->
                                <p>Client not found</p>
                                @endif
                                @elseif ($item->type_client === 'Not Existing')
                                {{ $item->new_client }}
                                @else
                                <!-- Jika $item->type_client tidak sesuai dengan kondisi di atas, tampilkan pesan alternatif -->
                                <p>No client information available</p>
                                @endif

                            </td>
                            <td>{{ $item->permintaan }}</td>
                            <td>
                                @if ($item->user_id == null)
                                @else
                                {{ explode(' ', $item->user->name)[0] }}

                                @endif
                            </td>
                            <td style="text-align: center">
                                <form method="POST" action="{{ route('coordination.destroy', $item->id) }}">
                                    @csrf
                                    @can('coordination.edit')
                                    <a href="{{ route('coordination.edit', $item->id) }}"
                                        class="btn btn-icon btn-warning btn-sm">
                                        <span class="ti ti-edit"></span>
                                    </a>
                                    @endcan
                                    @can('coordination.delete')
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

<script>
    function toggleClientFields() {
    var typeClient = document.getElementById('type_client').value;
    var existingClientDiv = document.getElementById('existing_client');
    var notExistingClientDiv = document.getElementById('not_existing_client');

    if (typeClient === 'Existing') {
        existingClientDiv.style.display = 'block';
        notExistingClientDiv.style.display = 'none';
    } else if (typeClient === 'Not Existing') {
        existingClientDiv.style.display = 'none';
        notExistingClientDiv.style.display = 'block';
    } else {
        existingClientDiv.style.display = 'none';
        notExistingClientDiv.style.display = 'none';
    }
}
</script>

@endsection