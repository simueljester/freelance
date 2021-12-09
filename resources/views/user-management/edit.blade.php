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
            <li class="breadcrumb-item"><a href="{{route('user-management.index')}}">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User </li>
        </ol>
    </nav>
</div>

<form action="{{route('user-management.update')}}" method="POST">
    @csrf
    @method('POST')

    <input type="hidden" name="user_id" id="" value="{{$user->id}}">
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> Basic Information </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> <i>  First Name </i>  </small>
                <input type="text" name="first_name" id="first_name" class="form-control p-3" value="{{$user->first_name}}" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Last Name </small>
                <input type="text" name="last_name" id="last_name" class="form-control p-3" value="{{$user->last_name}}" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Birthday </small>
                <input type="date" name="birthday" id="birthday"  class="form-control p-3" value="{{$user->birthday}}" required>
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
                <input type="text" name="address" id="address" class="form-control p-3" value="{{$user->address}}" required>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> <i> Account Information </i> </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> Email Address </small>
                <input type="email" value="{{$user->email}}" class="form-control p-3" disabled>
                <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control p-3" hidden>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> New Password </small>
                <input type="password" name="password" id="password" class="form-control p-3" >
                <input type="checkbox" onclick="myFunction()" class="mt-3"> Show Password
            </div>
            <div class="form-group">
                <small class="text-capialize"> Role </small>
                <select name="role" id="role" class="form-control" disabled>
                    <option value="2" {{$user->user_instance->role_id == 2 ? 'selected' : null }}> Teacher </option>
                    <option value="3" {{$user->user_instance->role_id == 3 ? 'selected' : null }}> User </option>
                </select>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <a href="{{route('user-management.index')}}" class="btn btn-outline-secondary"> Cancel </a>
            <button class="btn btn-info"> Save Changes </button>
        </div>
    </div>





    {{-- <div class="card shadow-sm mt-2">
        <div class="card-body">
            <strong> Edit User </strong> 
            <hr>
            <input type="hidden" name="user_id" id="" value="{{$user->id}}">
            <div class="form-group">
                <small class="text-capitalize"> Name </small>
                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Email Address </small>
                <input type="email" value="{{$user->email}}" class="form-control p-3" disabled>
                <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control p-3" hidden>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> New Password </small>
                <input type="password" name="password" id="password" class="form-control p-3">
            </div>
            <div class="form-group">
                <small class="text-capialize"> Role </small>
                <input type="text" name="password" id="password" class="form-control" value="{{$user->user_instance->role->role}}" disabled>
            </div>
            <hr>
    
        </div>
    </div> --}}
</form>

<div class="card mt-2 " style="background:transparent;border:none;">
    <div class="card-body text-right">
        <form action="{{route('user-management.delete')}}" method="POST" onclick="return confirm('Are you sure you want to delete this User?')">
            @csrf
            @method('POST')

            <input type="hidden" name="id_to_delete" id="id_to_delete" value="{{$user->id}}">
            <button class="btn btn-sm btn-danger" type="submit" style="cursor:pointer;"><i class="fas fa-trash-alt"></i> Delete User </button>
        </form>
    </div>
</div>

<script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>

@endsection
