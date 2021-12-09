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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group->id)}}"> {{$group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Exam </li>
        </ol>
    </nav>
</div>

{{-- Modal create exam  --}}
<form action="{{route('groups.exam.save')}}" method="POST">
    @csrf
    @method("POST")
   
    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <strong> Create Exam </strong>
            <hr>
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
            
            <div class="form-group mt-3">
                <span> Accessible Date </span>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="accessible_date" id="accessible_date"  class="form-control" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="accessible_time" id="accessible_time"  class="form-control" required>
                    </div>
                </div>
            </div>
         
            <hr>
            <div class="mt-3">
                <input type="hidden" name="folder_id" id="folder_id" value="{{$folder}}">
                <a href="{{route('groups.show',$group->id)}}" class="btn btn-outline-secondary"> Cancel </a>
                <button type="submit" class="btn btn-primary"> Create Exam </button>
            </div>
        </div>
    </div>
           
           
    
</form>


@endsection
