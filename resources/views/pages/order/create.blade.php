<form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-2 mb-3">
        <div class="col-md-12">
            <label for="order_id">No. Order</label>
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