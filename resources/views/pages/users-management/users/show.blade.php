@extends('layouts/master')

@section('title', 'Users')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                    @if ($data->image == null)
                    <img class="h-auto rounded-circle mt-3 mb-2"
                        src="https://ui-avatars.com/api/?name={{ $data->name }}?background=0D8ABC&color=fff"
                        height="120" width="120" alt="User avatar" />
                    @else
                    <img src="{{ asset('storage/profile/' . $data->image) }}" alt class="h-auto" height="150"
                        width="150" />
                    @endif
                    <div class="user-info text-center">
                        <h4>
                            {{ $data->name }}
                        </h4>
                        <span class="badge bg-light-success">
                            {{ $data->email }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-7 col-12">
                        <dl class="row mb-0">
                            <dt class="col-sm-5 fw-bolder mb-1">Name</dt>
                            <dd class="col-sm-7 mb-1">: {{ $data->name }}</dd>


                            <dt class="col-sm-5 fw-bolder mb-1">Email</dt>
                            <dd class="col-sm-7 mb-1">: {{ $data->email }}</dd>

                        </dl>
                    </div>
                    <div class="col-xl-5 col-12">
                        <dl class="row mb-0">
                            <dt class="col-sm-5 fw-bolder mb-1">Role</dt>
                            <dd class="col-sm-7 mb-1">: {{ $data->role->title ?? '--' }}</dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
