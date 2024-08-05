<form action="{{ route('blasting-email.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-2 mb-3">
        <div class="col-md-3">
            <label for="date">Blast Date</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>
        <div class="col-md-3">
            <label for="type_flayer">Type Flyer</label>
            <select name="type_flayer" id="type_flayer" class="form-select select2" required>
                <option value="Single Training">Single Training</option>
                <option value="Multi Training">Multi Training</option>
                <option value="Jadwal Bulanan">Jadwal Bulanan</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="file">Lampiran </label>
            <input type="file" name="file" class="form-control" id="file" required>
        </div>
        <div class="col-md-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </div>
    </div>

</form>
