@extends('layouts/master')

@section('title', 'Roles')

@section('content')
<!-- Invoice table -->
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Roles</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="John Doe"
                        name="title" value="{{ old('title', $role->title) }}" />
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
                            placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2"
                            name="short_code" value="{{ old('short_code', $role->short_code) }}" />
                        @error('short_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row g-4">
                    @php
                    $groupedPermissions = [];
                    foreach ($permissions as $id => $permission) {
                    $firstLetter = strtoupper(substr($permission, 0, 1));
                    $groupedPermissions[$firstLetter][$id] = $permission;
                    }
                    ksort($groupedPermissions);
                    @endphp

                    @foreach ($groupedPermissions as $letter => $permissionGroup)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="d-flex align-items-center mb-2">
                            <a href="javascript:;" class="d-flex align-items-center">
                                <div class="me-2 text-body h5 mb-0">{{ $letter }}</div>
                            </a>
                            <p class="mb-1">
                                @foreach ($permissionGroup as $id => $permission)
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        value="{{ $id }}" {{ (in_array($id, $role->permissions->pluck('id')->toArray()))
                                    ? 'checked' : '' }}>
                                    {{ $permission }}
                                </label>
                                @endforeach
                            </p>
                        </div>
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
<!-- /Invoice table -->
@endsection
