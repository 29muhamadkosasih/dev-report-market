<form method="POST" action="{{ route('permissions.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
            placeholder="Masukan Name Permissions" name="name" value="{{ old('name') }}" />
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary float-end ms-2">Submit</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary float-end ">Back</a>
</form>
