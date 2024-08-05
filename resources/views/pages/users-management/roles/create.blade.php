@extends('layouts/master')

@section('title', 'Roles')

@section('content')
<!-- Invoice table -->
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Roles</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Masukan Title" name="title" value="{{ old('title') }}" />
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Code</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class=" form-control @error('short_code') is-invalid @enderror"
                            placeholder="Masukan Short Code" aria-label="john.doe"
                            aria-describedby="basic-default-email2" name="short_code" value="{{ old('short_code') }}" />
                        @error('short_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <label class="form-label">Permissions</label>
                <div class="row g-4">
                    @php
                    $groupedPermissions = [];
                    foreach ($permissions as $id => $permission) {
                    $firstLetter = strtoupper(substr($permission, 0, 1));
                    $groupedPermissions[$firstLetter][$id] = $permission;
                    }
                    ksort($groupedPermissions); // Menyortir izin-izin berdasarkan huruf pertama (abjad) dari A-Z
                    @endphp

                    @foreach ($groupedPermissions as $letter => $permissionGroup)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="d-flex align-items-center mb-2">
                            <label class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input select-all" data-target="{{ $letter }}">
                                <div class="me-2 text-body h5 mb-0">{{ $letter }}</div>
                            </label>
                        </div>
                        <p class="mb-1">
                            @foreach ($permissionGroup as $id => $permission)
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input {{ $letter }}" name="permissions[]"
                                    value="{{ $id }}" {{ (in_array($id, old('permissions', []))) ? 'checked' : '' }}>
                                {{ $permission }}
                            </label>
                            <br>
                            @endforeach
                        </p>
                    </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary float-end ms-2">Submit</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary float-end ">Back</a>
            </form>
        </div>
    </div>
</div>
<script>
    // Script untuk mengatur checkbox "Select All"
                        document.querySelectorAll('.select-all').forEach(checkbox => {
                            checkbox.addEventListener('change', function () {
                                const targetClass = this.getAttribute('data-target');
                                const targetCheckboxes = document.querySelectorAll(`.${targetClass}`);
                                targetCheckboxes.forEach(cb => cb.checked = this.checked);
                            });
                        });
</script>
<!-- /Invoice table -->
@endsection