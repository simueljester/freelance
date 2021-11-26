@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-book-reader text-info"></i>  Subjects </h4>
        <small class="text-muted"> <i> Manage subjects </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"> <a href="{{route('subjects.index')}}"> Subjects </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$subject->name}} </li>
        </ol>
    </nav>
</div>


<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <strong> {{$subject->name}} </strong> </h5>
        <small> {{$subject->description}} </small>
        <hr>
   
        <div> Date Created: {{$subject->created_at->format('Y-m-d')}} </div>
    </div>
    <div class="card-footer">
        <span class="text-info" data-toggle="modal" data-target="#editSubject" style="cursor:pointer;"> <i class="fas fa-edit"></i> Edit </apn>
        &nbsp&nbsp
        <a href="#" class="text-danger"> <i class="fas fa-trash-alt"></i> Delete </a>
    </div>
</div>

<!-- Modal for Edit-->
<form action="{{route('subjects.update')}}" method="POST">
    @csrf
    @method("POST")
    <div class="modal fade" id="editSubject" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Edit {{$subject->name}} </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span> Name </span>
                    <input type="text" name="name" id="name" class="form-control" value="{{$subject->name}}">
                </div>
                <div class="form-group">
                    <span> Description </span>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"> {{$subject->description}} </textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</form>




@endsection
