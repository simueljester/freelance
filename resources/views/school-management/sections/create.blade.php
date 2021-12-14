@extends('school-management.index')

@section('sub-content')


<form action="{{route('school-management.sections.save')}}" method="POST">
    @csrf
    @method("POST")
    <strong> Create New Section </strong>
    <hr>

    <div class="form-group">
        <span> Name </span>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <span> Description (optional) </span>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
    <div>
        <a href="{{route('school-management.sections.index')}}" class="btn btn-outline-secondary"> Cancel </a>
        <button class="btn btn-primary"> Create Section </button>
    </div>
</form>


@endsection
