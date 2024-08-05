<form method="POST" action="{{ route('blasting-whatsapp.update', $edit->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row g-2 mb-3">
            <div class="col-md-3">
                <label for="date">Blast Date</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ $edit->date }}" required>
            </div>
            <div class="col-md-3">
                <label for="type_flayer">Type Flyer</label>
                <select name="type_flayer" id="type_flayer" class="form-select select2" required>
                    <option value="Single Training" @selected($edit->type_flayer == "Single Training")>Single Training
                    </option>
                    <option value="Multi Training" @selected($edit->type_flayer == "Multi Training")>Multi Training
                    </option>
                    <option value="Jadwal Bulanan" @selected($edit->type_flayer == "Jadwal Bulanan")>Jadwal Bulanan
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="file">Lampiran </label>
                <input type="file" name="file" class="form-control" id="file" value="{{ $edit->file }}">
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <a href="{{ route('blasting-whatsapp.index') }}" class="btn btn-label-secondary me-2 mt-4">
                    Back
                </a>
                <button type="submit" class="btn btn-primary mt-4">Update</button>
            </div>
        </div>

    </div>
</form>