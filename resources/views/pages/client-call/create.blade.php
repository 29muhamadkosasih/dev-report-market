<form action="{{ route('new-client-call.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-2 mb-3">
        <div class="col-md-12">
            <label for="client_id">Name Client</label>
            <select name="client_id" id="client_id" class="form-select select2" required>
                <option value="">Open this select</option>
                @foreach ($cus as $item)
                <option value="{{ $item->id_klien }}">{{ $item->nama_klien }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="date">Call Date</label>
            <input type="date" name="date" class="form-control" id="date">
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>