@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-users text-primary"></i>  User Management  </h4>
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
                <small class="text-capitalize"> <i>  First Name </i>  </small> <span class="text-danger"> * </span>
                <input type="text" name="first_name" id="first_name" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Last Name </small> <span class="text-danger"> * </span>
                <input type="text" name="last_name" id="last_name" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Birthday </small> <span class="text-danger"> * </span>
                <input type="date" name="birthday" id="birthday"  class="form-control p-3" required>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> <i> Physical Address </i> </strong>
            <hr>

            <div class="form-group">
                <small class="text-capitalize"> Address </small> <span class="text-danger"> * </span>
                <input type="text" name="address" id="address" class="form-control p-3" required>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> <i> Account Information </i> </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> Student ID (Applicable to students only) </small> <span class="text-danger"> * </span>
                <input type="number" name="student_id" id="student_id" class="form-control p-3" value="000000">
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Email Address </small> <span class="text-danger"> * </span>
                <input type="email" name="email" id="email" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Password (Atleast 10 characters required) </small> <span class="text-danger"> * </span>
                <input type="password" name="password" id="password" class="form-control p-3" required>
                <input type="checkbox" onclick="myFunction()" class="mt-3">  <span class="text-dark"> Show Password </span> 
                <button type="button" class="btn btn-sm btn-info ml-3" onclick="generateRandom(10)"> Generate Password </button>
            </div>
            <div class="form-group">
                <small class="text-capialize"> Role </small> <span class="text-danger"> * </span>
                <select name="role" id="role" class="form-control" required>
                    <option > Select Role </option>
                    <option value="2"> Teacher </option>
                    <option value="3"> Student </option>
                </select>
            </div>
            <div class="form-group">
                <small class="text-capialize"> Departments </small> <span class="text-danger"> * </span>
                <select name="department" id="department" class="form-control" required>
                    <option value=""> Select Department </option>
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}"> {{$department->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <small class="text-capialize"> Program </small> <span class="text-danger"> * </span>
                <select name="section" id="section" class="form-control" required>
                    <option value=""> Select Program </option>
                    @foreach ($sections as $section)
                        <option value="{{$section->id}}"> {{$section->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <a href="{{route('user-management.index')}}" class="btn btn-outline-secondary"> Cancel </a>
            <button class="btn btn-primary"> Create User </button>
        </div>
    </div>
</form>

@include('layouts.scripts')
<script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }


    
    $('#role').on('change', function() {
        role_id = this.value
        if(role_id == 2){
            document.getElementById("section").disabled = true;
            document.getElementById("section").value = 0;
        }else{
            document.getElementById("section").disabled = false;
        }
        
    });
    // $('#department').on('change', function() {
   
    //     department_id = this.value

    //     $.ajax({
    //         url: '/user-management/fetch-section/'+department_id  ,
    //         type: 'get',
    //         datetype:"json",
    //         // data: { user_id: user_id, group_id: group_id},
    //         beforeSend: function () {
     
    //         },
    //         success: function(data){
    //            var fetched_sections = data.sections
    //            var select = document.getElementById('section');
    //            $("#section option").remove(); // remove all values first before feeding new data
    //            $(select).append('<option  name="section"> Select Program </option>');
    //            fetched_sections.forEach(element => {
    //                 $(select).append('<option  name="section" value=' + element.id + '>' + element.name + '</option>');
    //             });
    //         }
    //     })
    // });

    function generateRandom(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
      
    }


    document.getElementById("password").value = result;

    
}



</script>

@endsection
