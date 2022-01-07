@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-user-circle text-primary"></i>  User Profile  </h4>
        <small class="text-muted"> <i> User information </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Profile</li>
        </ol>
    </nav>
</div>

<div class="card mt-3 shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 text-center">
                <form action="{{route('user-profile.save-avatar')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <p><input type="file"   accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;" ></p>
                    <p><img id="output" style="border-radius: 50%;" width="150" height="150" src="{{ url('/uploads/' . Auth::user()->avatar) ?? url('/uploads/default-avatar.png')}}" /></p>
                    <strong class="text-primary"> <i class="fas fa-upload"></i> <label for="file" style="cursor: pointer;">Upload Image</label></strong>
                    <div class="mt-3">
                        <button class="btn btn-primary btn-sm">  <i class="fas fa-check-circle"></i> Save Avatar </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="mt-3">
                    <strong style="font-size: 28px;" class="text-capitalize"> {{Auth::user()->name}} <small> {{Auth::user()->student_id}} </small> </strong> <br>
                    <strong style="font-size: 20px;"> <i class="fas fa-envelope"></i> <i> {{Auth::user()->email}} </i>  </strong> <br>
                    <strong style="font-size: 20px;"> <i class="fas fa-birthday-cake"></i> <i> {{  Auth::user()->birthday}} </i> </strong> <br>
                    <strong style="font-size: 20px;" class="text-capitalize"> <i class="fas fa-building"></i> <i> {{Auth::user()->address}} </i> </strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <form action="{{route('user-profile.save-new-password')}}" method="POST">
        @csrf
        @method('POST')
            <div class="card mt-3 shadow">
                <div class="card-header">
                    <strong> Password Management </strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <span> Old Password </span>
                        <input type="password" name="old_password" id="old_password" class="form-control" required> 
                        <input type="checkbox" onclick="showOld()" class="mt-3">  <small class="text-dark"> Show Old Password </small> 
                    </div>
                    <div class="form-group">
                        <span> New Password (Atleast 10 character required) </span>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                        <input type="checkbox" onclick="showNew()" class="mt-3">  <small class="text-dark"> Show New Password </small> 
                    </div>
                    <div class="form-group">
                        <span> Confirm New Password </span>
                        <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" required>
                        <input type="checkbox" onclick="showConfirm()" class="mt-3">  <small class="text-dark"> Show Confirm Password </small> 
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm"> <i class="fas fa-check-circle"></i> Save Password </button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
    <div class="col-sm-4">
    
    </div>

</div>


@include('layouts.scripts')
<script>
    function showOld() {
        var x = document.getElementById("old_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function showNew() {
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function showConfirm() {
        var x = document.getElementById("confirm_new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    var loadFile = function(event) {
	    var image = document.getElementById('output');
	    image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

@endsection
