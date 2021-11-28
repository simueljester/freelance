@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"> {{$group->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <strong> {{$group->name}} - <i> {{$group->subject->name}} </i>  </strong> </h5>
        <small> {{$group->description}} </small>
        <hr>
        <div> Creator: {{$group->user_creator->name}} </div>
        <div> Date Created: {{$group->created_at->format('Y-m-d')}} </div>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#assignUsers">
            <i class="fas fa-users"></i> Enrolled Users
        </button>
    </div>
</div>

@yield('folder')


<!-- Modal members -->
<form action="{{route('groups.group-assignment.unassign-users')}}" method="POST">
    @csrf
    @method("POST")
    
    <div class="modal fade" id="assignUsers" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong>  <i class="fas fa-users"></i> Group  Members </strong> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    
                <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">

                <table class="table table-hover mt-3">
                    <thead>
                        <th> Name </th>
                        <th> Email </th>
                        {{-- <th> Role </th> --}}
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($assigned_users as $user)
                            <tr>
                                <td> <a href="{{route('groups.user-exam-assignments',[$group,$user->user_id])}}" class="text-info"> {{$user->user->name}} </a> </td>
                                <td> {{$user->user->email}} </td>
                                {{-- <td> {{$user->user->user_instance->role->role}} </td> --}}
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="user_id[]" value="{{$user->user_id}}" class="form-check-input" style="cursor:pointer;" >
                                    </div>
                                </td>
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
                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign selected users? Users examination data will be deleted')"> Unassign Users </button>
                <a href="{{route('groups.group-assignment.assignment',$group)}}" class="btn btn-info btn-sm" > <i class="fas fa-user-plus"></i> Assign New Users  </a>
            </div>
        </div>
        </div>
    </div>
</form>




@endsection
