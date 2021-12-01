@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-users text-info"></i>  User Management  </h4>
        <small class="text-muted"> <i> Create, Update and Delete user accounts </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user-management.index')}}">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User </li>
        </ol>
    </nav>
</div>

<form action="{{route('user-management.save-user')}}" method="POST">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> Basic Information </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> <i>  First Name </i>  </small>
                <input type="text" name="first_name" id="first_name" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Last Name </small>
                <input type="text" name="last_name" id="last_name" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Birthday </small>
                <input type="date" name="birthday" id="birthday"  class="form-control p-3" required>
            </div>
            
            {{-- <div class="form-group">
                <small class="text-capitalize"> Name </small>
                <input type="text" name="name" id="name" class="form-control p-3" required>
            </div> --}}
        </div>
    </div>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> <i> Physical Address </i> </strong>
            <hr>

            <div class="form-group">
                <small class="text-capitalize"> Address </small>
                <input type="text" name="address" id="address" class="form-control p-3" required>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> <i> Account Information </i> </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> Email Address </small>
                <input type="email" name="email" id="email" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Password </small>
                <input type="password" name="password" id="password" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capialize"> Role </small>
                <select name="role" id="role" class="form-control" required>
                    <option value="2"> Teacher </option>
                    <option value="3"> User </option>
                </select>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <a href="{{route('user-management.index')}}" class="btn btn-outline-secondary"> Cancel </a>
            <button class="btn btn-info"> Create User </button>
        </div>
    </div>
</form>


@endsection
