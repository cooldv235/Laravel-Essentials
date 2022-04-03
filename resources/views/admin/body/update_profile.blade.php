@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Update your profile</h2>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <div class="card-body">
        <form action="{{ route('update.user.profile') }}" method="post" class="form-pill">
            @csrf
            <div class="form-group">
                <label for="current_password">Username</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user['name'] }}">
            </div>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror

            <div class="form-group">
                <label for="current_password">User email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user['email'] }}">
            </div>
            @error('email')
            <p class="text-danger">{{$message}}</p>
            @enderror

            <button class="btn btn-success btn-default" type="submit">Update</button>
        </form>
    </div>
</div>



@endsection