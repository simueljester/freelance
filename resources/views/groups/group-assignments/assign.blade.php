@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group->id)}}"> {{$group->name}}  </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Assign Users </li>
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
            <small> Assign users to this class </small>
            <table class="table table-hover mt-3">
                <thead>
                    <th> Name </th>
                    <th> Email </th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($all_users as $user)
                        @if ($user->user_instance->role_id == 3)
                            <tr>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
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



@endsection
