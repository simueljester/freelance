@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-book-reader text-primary"></i>  Subjects </h4>
        <small class="text-muted"> <i> Manage subjects </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"> <a href="{{route('subjects.index')}}"> Subjects </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Create </li>
        </ol>
    </nav>
</div>

<form action="{{route('subjects.save')}}" method="POST">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-2">
        <div class="card-body">
           <strong> Create New Subject </strong>
           <hr>
           <div class="form-group">
               <span> Name </span>
               <input type="text" name="name" id="name" class="form-control" required>
           </div>
           <div class="form-group">
                <span> Course Code </span>
                <input type="text" name="course_code" id="course_code" class="form-control" required>
            </div>
           <div class="form-group">
                <span> Description (optional) </span>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            
            <div>
                <a href="{{route('subjects.index')}}" class="btn btn-outline-secondary"> Cancel </a>
                <button class="btn btn-primary"> Create Subject </button>
            </div>
        </div>
    </div>
</form>


@endsection
