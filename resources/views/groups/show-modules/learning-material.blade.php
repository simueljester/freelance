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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$learning_material->group)}}"> {{$learning_material->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$learning_material->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <i class="fas fa-file-signature fa-2x text-warning m-1"></i>  <strong> {{$learning_material->name}} </strong> &nbsp&nbsp   </h5>
        <small> {!! $learning_material->description ?? 'No details provided' !!} </small>
        <hr>
        <div>
   
            <a href="{{route('groups.show',$learning_material->group_id)}}" class="text-primary"> <i class="fas fa-cube"></i> {{$learning_material->group->name}} </a>
            &nbsp&nbsp
            <a href="{{route('groups.learning-material.edit',$learning_material)}}" class="text-primary"> <i class="fas fa-edit "></i> Edit Learning Material </a>
            
            &nbsp&nbsp
            <a href="{{route('groups.learning-material.delete',$learning_material)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this learning material? All learning material assignments will be deleted')"> <i class="fas fa-trash-alt"></i> Delete Learning Material </a>
           
            &nbsp&nbsp 
            @if ($learning_material->file)
                <i class="fas fa-paperclip"></i> <a href="{{route('downloads.learning-material-attachment',[$learning_material->file,$learning_material->group])}}" class="text-primary"> {{$learning_material->file}} </a>
            @endif
        
        </div>
    </div>
</div>

<div class="row">
   
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <strong> <i class="fas fa-users"></i> User Learning Material Assignments </strong> 
                <table class="table table-hover mt-3">
                    <thead>
                        <th> User </th>
              
                    </thead>
                    <tbody>
                        @forelse ($learning_material_assignments as $assignment)
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
