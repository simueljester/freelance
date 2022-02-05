@extends('school-management.index')

@section('sub-content')


<form action="{{route('school-management.sections.save')}}" method="POST">
    @csrf
    @method("POST")
    <strong> Create New Program </strong>
    <hr>

    <div class="form-group">
        <span> Name </span> <span class="text-danger"> * </span>
        <input type="text" name="section_name" id="section_name" class="form-control" required>
    </div>

    <div class="form-group">
        <span> Description (optional) </span>
        <textarea name="section_description" id="section_description" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
    <div>
        <a href="{{route('school-management.sections.index')}}" class="btn btn-outline-secondary"> Cancel </a>
        <button class="btn btn-primary"> Create Program </button>
    </div>
</form>


@endsection
