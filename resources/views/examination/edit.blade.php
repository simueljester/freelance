@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-paste text-white text-primary"></i>  Examination  </h4>
        <small class="text-muted"> <i> Manages examination details, assignment, questions and settings </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('examination.index')}}">Examination</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit {{$exam->name}} </li>
        </ol>
    </nav>
</div>

<form action="{{route('examination.update')}}" method="POST">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong class="text-muted"> Edit Exam </strong>
            <hr>
            <div class="form-group mt-3">
                <span> Name </span>
                <input type="text" name="name" id="name" class="form-control" value="{{$exam->name}}" required>
            </div>
            <div class="form-group mt-3">
                <span> Description (optional) </span>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control"> {{$exam->description}} </textarea>
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <input type="hidden" name="group" id="group" value="{{$exam->group_id}}">
                <input type="text" class="form-control" value="{{$exam->group->name}}" disabled>
            </div>
            <div class="form-group mt-3">
                <span> Duration (Minutes) </span>
                <input type="number" name="duration" min="1" id="duration" value="{{$exam->duration}}"  class="form-control" required>
            </div>
            <hr>
            <div>
                <input type="hidden" name="exam_id" id="exam_id" value="{{$exam->id}}">
                <a href="{{route('examination.show',$exam->id)}}" class="btn btn-outline-secondary btn-sm" > Cancel </a>
                <button class="btn btn-primary btn-sm"> Save Changes </button>
            </div>
        </div>
    </div>
</form>

@endsection
