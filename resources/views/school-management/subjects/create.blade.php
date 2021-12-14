@extends('school-management.index')

@section('sub-content')


<form action="{{route('school-management.subjects.save')}}" method="POST">
    @csrf
    @method("POST")
   
        
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
       
  
</form>


@endsection
