<form action="{{ route('quotation-letter.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-2 mb-3">
        <div class="col-md-12">
            <label for="no_ql_id">No. QL</label>
            <select name="no_ql_id" id="no_ql_id" class="form-select select2" required>
                <option value="">Open this select</option>
                @foreach ($ql as $item)
                <option value="{{ $item->id_penawaran }}">{{ $item->no_penawaran }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>