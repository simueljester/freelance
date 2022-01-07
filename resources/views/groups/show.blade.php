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
            <li class="breadcrumb-item"> {{$group->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <i class="fas fa-cube text-primary"></i> <strong> {{$group->name}} </strong> </h5>
        <small> {{$group->description}} </small>
        <hr>
     
        <i class="fas fa-book-reader"></i> Course Code:  <strong> {{$group->subject->course_code}} </strong>
        <br>
        <i class="fas fa-user"></i> Assign Teacher: <strong> {{$group->user_creator->name}} </strong>
        <br>
        <i class="fas fa-flag"></i> Active AY: <strong> {{$group->activeAcademicYear->name}} </strong>
        <br>
        <i class="fas fa-adjust"></i> Program: <strong> {{$group->section->name}} </strong>
        <div> <i class="fas fa-calendar-alt"></i> Date Created: <strong> {{$group->created_at->format('Y-m-d')}}  </strong> </div>
    </div>
    <div class="card-footer">

        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assignUsers">
            <i class="fas fa-users"></i> Enrolled Users
        </button>
      
        <a href="{{route('groups.class-grades.index',$group)}}" class="btn btn-primary btn-sm"> <i class="fab fa-cloudsmith"></i> Class Grades </a>
    </div>
</div>

@yield('folder')


<!-- Modal members -->
<form action="{{route('groups.group-assignment.unassign-users')}}" method="POST">
    @csrf
    @method("POST")
    
    <div class="modal fade" id="assignUsers" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <strong>  <i class="fas fa-users"></i> Enrolled Users </strong> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    
                <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">

                <table class="table table-hover mt-3">
                    <thead>
                        <th></th>
                        <th> Student ID </th>
                        <th> Name </th>
                        <th> Email </th>
                        
                        {{-- <th> Role </th> --}}
                        <th> Remove </th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($assigned_users as $user)
                            <tr>
                                <td> <img  width="30" height="30" style="border-radius: 50%;" src="{{ url('/uploads/' . $user->user->avatar) ?? url('/uploads/default-avatar.png')}}" /></td>
                                <td> {{$user->user->student_id}} </td>
                                <td> <a href="{{route('groups.user-data',$user)}}" class="text-primary"> {{$user->user->name}} </a> </td>
                                <td> {{$user->user->email}} </td>
                                {{-- <td> {{$user->user->user_instance->role->role}} </td> --}}
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="user_id[]" value="{{$user->user_id}}" class="form-check-input" style="cursor:pointer;" >
                                    </div>
                                </td>
                                <td> <a href="{{route('groups.user-data',$user)}}" class="btn btn-sm btn-primary"> View Class Participation </a> </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No users assigned </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                @if (Auth::user()->user_instance->role_id == 1)
                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign selected users? Users examination data will be deleted')"> Unassign Users </button>
                    <a href="{{route('groups.group-assignment.assignment',$group)}}" class="btn btn-primary btn-sm" > <i class="fas fa-user-plus"></i> Assign New Users  </a>
                @endif
            </div>
        </div>
        </div>
    </div>
</form>




@endsection
