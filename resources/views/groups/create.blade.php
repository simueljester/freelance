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
            <li class="breadcrumb-item active" aria-current="page">Create Group </li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.save')}}" method="POST">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong> Create Group </strong>
            <hr>
            <div class="form-group">
                <small class="text-capitalize"> Name </small>
                <input type="text" name="name" id="name" class="form-control p-3" required>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Description </small>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <small class="text-capitalize"> Subject </small>
                <select name="subject" id="subject" class="form-control" required>
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}"> {{$subject->name}} </option>
                    @endforeach
                </select>
            </div>
            <hr>
            <a href="{{route('groups.index')}}" class="btn btn-outline-secondary btn-sm"> Cancel </a>
            <button class="btn btn-info btn-sm"> Create Group </button>
        </div>
    </div>
</form>


@endsection
