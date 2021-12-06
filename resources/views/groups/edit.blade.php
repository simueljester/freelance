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
                <small class="text-capitalize"> Name </small>
                <input type="text" name="name" id="name" class="form-control p-3" value="{{$group->name}}" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Description </small>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" required> {{$group->description}} </textarea>
            </div>
            <hr>
            <a href="{{route('groups.index')}}" class="btn btn-outline-secondary btn-sm"> Cancel </a>
            <button class="btn btn-primary btn-sm"> Save Changes </button>
        </div>
    </div>
</form>


@endsection
