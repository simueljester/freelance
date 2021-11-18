@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-users text-info"></i>  User Management  </h4>
        <small class="text-muted"> <i> Create, Update and Delete user accounts </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-2 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Management</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-2">
    <div class="card-body">
        <div>
            <a href="{{route('user-management.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i> Create New User </a>
        </div>
        <br>
        <strong class="mt-3"> User List </strong>
        <hr>
        <table class="table table-hover">
            <thead>
                <th> Name </th>
                <th> Email </th>
                <th> Role </th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td> 
                            @if($user->user_instance)
                               {{$user->user_instance->role->role}} 
                            @else
                                No active role
                            @endif
                        </td>
                        <td>
                            <a href="{{route('user-management.edit',$user)}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> Edit </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"> No user created </td>
                    </tr>
                @endforelse
         
            </tbody>
        </table>
    </div>
</div>

{{-- <form action="{{route('user-management.save-user')}}" method="POST">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-2">
        <div class="card-body">
            <strong> Create User </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> Name </small>
                <input type="text" name="name" id="name" class="form-control p-3" required>
            </div>
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
            <hr>
            <button class="btn btn-info"> Create User </button>
        </div>
    </div>
</form> --}}


@endsection
