@extends('layouts/master')

@section('title', 'Users')

@section('content')
<div class="offset-2 col-8">
    <div class="card">
        <div class="card-body">
            <h5 class="small text-uppercase text-muted">Details</h5>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <span class="fw-medium me-1">Title</span>
                        <span> : {{ $role->title }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Short Code</span>
                        <span>: {{ $role->short_code ?? "--" }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Permissions</span>
                        <span>
                            : @forelse ($role->permissions as $permission)
                            <span class="badge bg-label-success mb-1"> {{ $permission->name }}</span>
                            @empty
                            No Permissions
                            @endforelse
                        </span>
                    </li>
            </div>
        </div>
    </div>
</div>
@endsection
