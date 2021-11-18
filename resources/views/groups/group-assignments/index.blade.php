@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$group->name}} </li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.group-assignment.unassign-users')}}" method="POST">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3 p-1"> 
        <div class="card-body">
            <h5 class="text-muted"> {{$group->name}} </h5>
    
            <small> {{$group->description}} </small>
    
            <div class="mt-3"> 
                <a href="{{route('groups.group-assignment.assignment',$group)}}" class="btn btn-info btn-sm"> <i class="fas fa-user-plus"></i> Assign Users  </a>
                <button type="submit" class="btn btn-outline-danger btn-sm"> Unassign Selected Users </button>
            </div>
            
            <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
            
            <table class="table table-hover mt-3">
                <thead>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Role </th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse ($assigned_users as $user)
                        <tr>
                            <td> <a href="" class="text-info"> {{$user->user->name}} </a> </td>
                            <td> {{$user->user->email}} </td>
                            <td> {{$user->user->user_instance->role->role}} </td>
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
    </div>
</form>


@endsection
