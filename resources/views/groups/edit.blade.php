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
            <li class="breadcrumb-item active" aria-current="page">Edit Class </li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.update')}}" method="POST">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> Edit Class </strong>
            <hr>
            <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
            <div class="form-group">
                <small class="text-capitalize"> Name </small> <span class="text-danger"> * </span>
                <input type="text" name="name" id="name" class="form-control p-3" value="{{$group->name}}" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Description </small> <span class="text-danger"> * </span>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" required> {{$group->description}} </textarea>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Main Instructor </small> 
                <input type="text" name="name" id="name" class="form-control p-3" value="{{$group->user_creator->name}}" disabled>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addInstructorModal">
                    <i class="fas fa-user-plus"></i> Add Instructor
                </button>
            </div>
            <br>
            <hr>
            <a href="{{route('groups.index')}}" class="btn btn-outline-secondary btn-sm"> Cancel </a>
            <button class="btn btn-primary btn-sm"> Save Changes </button>
        </div>
    </div>
</form>

<!-- Modal -->

<form action="{{route('groups.add-instructor')}}" method="POST">
    @csrf
    @method('POST')
    <div class="modal fade" id="addInstructorModal" tabindex="-1" role="dialog" aria-labelledby="addInstructorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addInstructorModalLabel"> Add Instructor </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead> 
                        <th> Name </th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($group->instructorAssignments as $assignment)
                            <tr>
                                <td> <i class="fas fa-user"></i> {{$assignment->instuctor->name}} </td>
                                <td> <a href="{{route('groups.remove-instructor',$assignment)}}"  onclick="return confirm('Are you sure you want to remove this instructor from this class? ')" class="text-danger"> Remove </a> </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2"> No other instructor assigned </td>
                            </tr>
                        @endforelse
                 
                    </tbody>
                </table>
                <br>
                <select name="instructor_id" id="instructor_id" class="form-control" required>
                    <option value=""> Select Instructor </option>
                    @foreach ($instructors as $instructor)
                        @if($instructor->user->id == $group->creator_id)
                        @else
                            <option value="{{$instructor->user->id}}">  {{$instructor->user->name}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>
</form>



@endsection
