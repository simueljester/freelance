@extends('school-management.index')

@section('sub-content')


<form action="{{route('school-management.subjects.save')}}" method="POST">
    @csrf
    @method("POST")
    <strong> Create New Subject </strong>
    <hr>
    <div class="form-group">
        <span> Department</span> <span class="text-danger"> * </span>
        <select name="department" id="department" class="form-control" required>
            @foreach ($departments as $department)
                <option value="{{$department->id}}"> {{$department->name}} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <span> Descriptive Title </span> <span class="text-danger"> * </span>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <span> Subjects / Course Code <small> (Special characters not allowed. White spaces automatically convert to '-') </small> </span> <span class="text-danger"> * </span>
        <input type="text" name="course_code" id="course_code" class="form-control" required>
    </div>
    <div class="form-group">
        <span> Description (optional) </span>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
    <div>
        <a href="{{route('school-management.subjects.index')}}" class="btn btn-outline-secondary"> Cancel </a>
        <button class="btn btn-primary"> Create Subjects </button>
    </div>
</form>


@include('layouts.scripts')

<script>
    $('#course_code').on('keypress', function (event) {
        var regex = new RegExp("^[0-9a-zA-Z \b]+$");
var key = String.fromCharCode(!event.charCode ? event.which: event.charCode);
if (!regex.test(key)) 
{
    event.preventDefault();
    return false;
} 
    });
</script>

@endsection
