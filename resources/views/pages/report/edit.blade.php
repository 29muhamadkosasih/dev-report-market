<form method="POST" action="{{ route('report.update', $edit->id) }}">
    @csrf
    @method('PUT')
    <div class="row g-2 mb-3">
        <div class="col-md-3">
            <label for="jon">Name</label>
            <select name="user_id" id="jon" class="form-select select2" required>
                <option value="{{ $edit->id }}" selected>{{ $edit->user->name }}</option>
                @foreach ($user as $item)
                <option value="{{ $item->id }}" @if ($item->id == $edit->user_id) selected @endif>
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="order_id">Month</label>
            <input type="month" class="form-control" placeholder="Enter" name="month"
                value="{{ $edit->month ? \Carbon\Carbon::parse($edit->month)->format('Y-m') : '' }}" required>
        </div>
        <div class="col-md-3">
            <label for="order_id">New Client Call</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="client_call" value="{{ $edit->client_call }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Blasting Email</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="blasting_email" value="{{ $edit->blasting_email }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Blasting WhatsApp</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="blasting_whatsapp" value="{{ $edit->blasting_whatsapp }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Client Visit</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="client_visit" value="{{ $edit->client_visit }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">QL Terkirim</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="ql_send" value="{{ $edit->ql_send }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Penerimaan PO</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="pen_po" value="{{ $edit->pen_po }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Jumlah Training</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="jumlah_training" value="{{ $edit->jumlah_training }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Qty Jumlah Peserta</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter" name="qty_peserta" value="{{ $edit->qty_peserta }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <label for="order_id">Revenue (Rp.)</label>
            <div class="input-group">
                <input type="text" class="form-control unit-price-input" placeholder="Enter" name="revenue" value="{{ $edit->revenue }}" required>
                <span class="input-group-text">Week</span>
            </div>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary mt-4 float-end ms-2">Submit</button>
            <a href="{{ route('report.index') }}" class="btn mt-4 btn-secondary float-end ">Back</a>
        </div>

    </div>
</form>
