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
        <h5 class="text-muted"> <strong> {{$group->name}} </strong> </h5>
        <small> {{$group->description}} </small>
        <hr>
        <div> Creator: {{$group->user_creator->name}} </div>
        <div> Date Created: {{$group->created_at->format('Y-m-d')}} </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
         
                <strong>  <i class="fas fa-users"></i> Group  Members </strong> 
                <br>
                <small> Users belong to this group </small>

                <form action="{{route('groups.group-assignment.unassign-users')}}" method="POST">
                    @csrf
                    @method("POST")
                    
                    <div class="mt-5"> 
                        <a href="{{route('groups.group-assignment.assignment',$group)}}" class="btn btn-info btn-sm" > <i class="fas fa-user-plus"></i> Assign Users  </a>
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to unassign selected users?')"> Unassign Selected Users </button>
                    </div>
                    
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
                                    <td> <a href="" class="text-info"> {{$user->user->name}} </a> </td>
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
                </form>
              
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">

            @if(count($assigned_users) > 0)

                <div class="card-body">
                    <strong> <i class="fas fa-paste"></i> Created Exams </strong>
                    <br>
                    <small> Exams created belong to this group </small>
                    <div class="mt-3">
                        <ul>
                            @forelse ($created_exam as $exam)
                                <li> <a href="{{route('examination.show',$exam)}}" class="text-info"> {{$exam->name}}  </a> </li>
                            @empty
                                <li> No exam created to this group </li>
                            @endforelse
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <button class="btn btn-info btn-block btn-sm"  data-toggle="modal" data-target="#assignExam"> <i class="fas fa-plus"></i> Create New Exam </button>
                    </div>
                </div>

            @endif

        </div>
    </div>
</div>



<form action="{{route('examination.save')}}" method="POST">
    @csrf
    @method("POST")
    <div class="modal fade" id="assignExam" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Created New Exam  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-1">
                        <span> Name </span>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <span> Description (optional) </span>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <span> Group </span>
                        <input type="hidden" name="group" id="group" value="{{$group->id}}" class="form-control">
                        <input type="text" value="{{$group->name}}" class="form-control" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <span> Duration (Minutes) </span>
                        <input type="number" name="duration" min="1" id="duration" value="1"  class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>


@endsection
