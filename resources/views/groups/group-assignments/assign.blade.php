@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Class  </h4>
        <small class="text-muted"> <i> Class Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Class</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group->id)}}"> {{$group->name}}  </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Enroll Users </li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.group-assignment.assign-users')}}" method="POST">
    @csrf
    @method("POST")
    <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
    <div class="card shadow-sm mt-3 p-1"> 
        <div class="card-body">
            
            <strong> Available Users </strong> <br>
            <small> Assign users to this class, As an admin you may enroll users from different sections and departments </small>
            <div class="form-group mt-3">
                <span> <i class="fas fa-search"></i> Search User Name </span>
                <input type="text" name="search" id="search" class="form-control" onkeyup="searchUser()">
            </div>
            <table class="table table-hover mt-3" id="table-user">
                <thead>
                    <th></th>
                    <th> Student ID </th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Role </th>
                    <th> Section </th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($all_users as $user)
                        @if ($user->user_instance->role_id == 3)
                            <tr>
                                <td> <img  width="30" height="30" style="border-radius: 50%;" src="{{ url('/uploads/' . $user->avatar) ?? url('/uploads/default-avatar.png')}}" /></td>
                                <td> {{$user->student_id}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> Student </td>
                                <td> 
                                    @if ($user->user_instance->section)
                                        {{$user->user_instance->section->name}} 
                                    @else
                                        No section assigned to this user
                                    @endif 
                                </td>
                                <td>  
                                    @if(in_array($user->id, $assigned_users))
                                        <h6><span class="badge badge-success"> Assigned </span></h6>
                                    @else
                                        <div class="form-check">
                                            <input type="checkbox" name="user_id[]" value="{{$user->id}}" class="form-check-input" style="cursor:pointer;">
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                      
                    @endforeach
                </tbody>
            </table>
            <hr>
            <a href="{{route('groups.show',$group->id)}}" class="btn btn-outline-secondary btn-sm"> Cancel </a>
            <button class="btn btn-primary btn-sm"> Assign User </button>
        </div>
    </div>

</form>

<script>

    function searchUser(filter) {  
        if (filter == undefined)
        filter = document.getElementById("search").value.toUpperCase();
        var table = document.getElementById("table-user");   
        var tr = table.getElementsByTagName("tr");  
        for (var i = 0; i < tr.length; i++){
            var td = tr[i].getElementsByTagName("td")[0];
            if (td){
                var txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>

@endsection
