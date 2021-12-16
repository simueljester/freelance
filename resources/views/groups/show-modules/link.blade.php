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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$link->group)}}"> {{$link->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$link->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <i class="fas fa-link fa-2x text-danger"></i> <strong> {{$link->name}} </strong> &nbsp&nbsp   </h5>
        <small> {!! $link->description ?? 'No details provided' !!} </small>
        <hr>
        <div>
   
            <a href="{{route('groups.show',$link->group_id)}}" class="text-primary"> <i class="fas fa-cube"></i> {{$link->group->name}} </a>
            &nbsp&nbsp
            <a href="{{route('groups.link.edit',$link)}}" class="text-primary"> <i class="fas fa-edit "></i> Edit Link </a>
         
            &nbsp&nbsp
            <a href="{{route('groups.link.delete',$link)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this link? All link assignments will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Link </a>
            &nbsp&nbsp
            <span class="float-right">
                <i class="{{$link->groupModule->visibility == 1 ? 'fas fa-eye text-success' : 'fas fa-eye-slash text-secondary'}}"></i>
                <small>  {{$link->groupModule->visibility == 1 ? 'Visible to student' : 'Hidden to student'}} </small>
            </span>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <i class="fas fa-link"></i> <a href="{{$link->link}}" target="_blank"> {{$link->name}} </a>
    </div>
</div>

<div class="row">
   
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <strong> <i class="fas fa-users"></i> User Link Assignments </strong> 
                <table class="table table-hover mt-3">
                    <thead>
                        <th> User </th>
              
                    </thead>
                    <tbody>
                        @forelse ($link_assignments as $assignment)
                            <tr>
                                <td> <i class="fas fa-user"></i> {{$assignment->user->name}} </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No users found in this learning material. To assign users, Click <strong> Edit Exam </strong> then save changes </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
     
    </div>
</div>



@endsection
