<form action="{{ route('coordination.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-2 mb-3">
        <div class="col-md-12">
            <label for="date"> Date</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>
        <div class="col-md-12">
            <label for="dept"> Dept/BU</label>
            <input type="text" name="dept" class="form-control" id="dept" placeholder="Enter" required>
        </div>

        <div class="col-md-12">
            <label for="type_client">Type Client</label>
            <select name="type_client" id="type_client" class="form-select select2" onchange="toggleClientFields()"
                required>
                <option value="">Open This Select</option>
                <option value="Existing">Existing</option>
                <option value="Not Existing">Not Existing</option>
            </select>
        </div>

        <div class="col-md-12" id="existing_client" style="display: none;">
            <label for="existing_client_select">Client</label>
            <select name="client" id="existing_client_select" class="form-select select2">
                <option value="">Open this select</option>
                @foreach ($cus as $item)
                <option value="{{ $item->id_klien }}">{{ $item->nama_klien }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12" id="not_existing_client" style="display: none;">
            <label for="new_client">New Client</label>
            <input type="text" name="new_client" id="new_client" class="form-control" placeholder="Enter client name">
        </div>

        <div class="col-md-12">
            <label for="permintaan">Request </label>
            <input type="text" placeholder="Enter" name="permintaan" class="form-control" id="permintaan" required>
        </div>
        <div class="col-md-12">
            <label for="fo">Follow Up </label>
            <input type="text" placeholder="Enter" name="fo" class="form-control" id="fo" required>
        </div>
        <div class="col-md-12">
            <label for="ket">Keteranan </label>
            <textarea name="ket" id="ket" cols="3" rows="3" class="form-control" placeholder="Enter"></textarea>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>