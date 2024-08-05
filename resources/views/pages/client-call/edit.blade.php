<form method="POST" action="{{ route('new-client-call.update', $edit->id) }}">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row g-2 mb-3">
            <div class="col-md-12">
                <label for="client_id">Name Client</label>
                <select name="client_id" id="client_id" class="form-select select2" required>
                    <option value="{{ $edit->client->id_klien }}" selected>{{ $edit->client->nama_klien }}</option>
                    @foreach ($cus as $item)
                    <option value="{{ $item->id_klien }}" @if($item->id_klien == $edit->client->id_klient) selected
                        @endif>
                        {{ $item->nama_klien }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <label for="date">Call Date</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ $edit->date }}">
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('new-client-call.index') }}" class="btn btn-label-secondary me-2" data-bs-dismiss="modal">
                Back
            </a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>