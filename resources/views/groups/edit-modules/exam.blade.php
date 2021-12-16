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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$exam->group)}}"> {{$exam->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('groups.exam.show',$exam)}}"> {{$exam->name}} </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit</li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.exam.update')}}" method="POST">
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
            <div class="form-group mt-3">
                <span> Accessible Date </span>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="accessible_date" id="accessible_date"  class="form-control" value="{{Carbon\Carbon::parse($exam->accessible_at)->format('Y-m-d')}}" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="accessible_time" id="accessible_time"  class="form-control" value="{{Carbon\Carbon::parse($exam->accessible_at)->format('H:i')}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <span> Expiration Date </span>
                <br>
                <small class="text-muted"> Students may not be able to access this exam after set expiration date </small>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="expiration_date" id="expiration_date"  class="form-control" value="{{Carbon\Carbon::parse($exam->expired_at)->format('Y-m-d')}}" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="expiration_time" id="expiration_time"  class="form-control" value="{{Carbon\Carbon::parse($exam->expired_at)->format('H:i')}}" required>
                    </div>
                </div>
            </div>
            <div>
                <input type="hidden" name="exam_id" id="exam_id" value="{{$exam->id}}">
                <a href="{{route('groups.exam.show',$exam)}}" class="btn btn-outline-secondary btn-sm" > Cancel </a>
                <button class="btn btn-primary btn-sm"> Save Changes </button>
            </div>
        </div>
    </div>
</form>

@endsection
