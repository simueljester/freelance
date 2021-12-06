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
            <li class="breadcrumb-item active" aria-current="page"> Create Exam </li>
        </ol>
    </nav>
</div>

<form action="{{route('examination.save')}}" method="POST">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong class="text-muted"> Create Exam </strong>
            <hr>
            <div class="form-group mt-3">
                <span> Name </span>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <span> Description (optional) </span>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <select name="group" id="group" cols="30" rows="5" class="form-control" required>
                    @forelse ($groups as $group)
                        <option value="{{$group->id}}"> {{$group->name}} </option>
                    @empty
                        <option value=0> </option>
                    @endforelse
                </select>
            </div>
            <div class="form-group mt-3">
                <span> Duration (Minutes) </span>
                <input type="number" name="duration" min="1" id="duration" value="1"  class="form-control" required>
            </div>
            <hr>
            <div>
                <a href="{{route('examination.index')}}" class="btn btn-outline-secondary btn-sm" > Cancel </a>
                <button class="btn btn-primary btn-sm"> Create Exam </button>
            </div>
        </div>
    </div>
</form>

@endsection
