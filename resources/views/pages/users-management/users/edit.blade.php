@extends('layouts/master')

@section('content')
@section('title', 'Users')
<!-- Invoice table -->
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Users</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"></label>
                    <label class="form-label" for="multicol-country">Roles</label>
                    <select id="multicol-country" class="select2 form-select" data-allow-clear="true" name="role_id">
                        <option value="" selected hidden>Please Select</option>
                        @foreach ($roles as $id => $role)
                        <option value="{{$id}}" {{ (old('role_id', '' )==$id ) ? 'selected' : '' }}>{{$role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Name</label>
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe"
                        name="name" value="{{ old('name', $user->name) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basicInput">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="basicInput"
                        name="username" placeholder="Enter" value="{{ old('username', $user->username) }}" required />
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="basic-default-email" class="form-control" placeholder="john.doe"
                            aria-label="john.doe" aria-describedby="basic-default-email2" name="email" name="email"
                            value="{{ old('email', $user->email) }}" />
                    </div>
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            name="password" required autocomplete="current-password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary float-end ms-2">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary float-end ">Back</a>
            </form>
        </div>
    </div>
</div>
<!-- /Invoice table -->
@endsection
