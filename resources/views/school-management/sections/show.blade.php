@extends('school-management.index')

@section('sub-content')

<div class="p-2">
  <h5 class="text-muted"> <strong> {{$section->name}} </strong> </h5> 
  <small> {{$section->description}} </small>
  <hr>
  <a href="{{route('school-management.sections.index')}}" class="text-muted"> <i class="far fa-arrow-alt-circle-left"></i> Back </a>
  &nbsp&nbsp
  <span class="text-primary" data-toggle="modal" data-target="#editSection" style="cursor:pointer;"> <i class="fas fa-edit"></i> Edit </span>
  &nbsp&nbsp
  <a href="{{route('school-management.sections.delete',$section)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this section? Classes assign to this section will be deleted')"> <i class="fas fa-trash-alt"></i> Delete </a>
  &nbsp&nbsp
  Date Created: {{$section->created_at->format('Y-m-d')}} 
</div>


<!-- Modal for Edit-->
<form action="{{route('school-management.sections.update')}}" method="POST">
    @csrf
    @method("POST")
    <div class="modal fade" id="editSection" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Edit {{$section->name}} </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span> Name </span>
                    <input type="text" name="name" id="name" class="form-control" value="{{$section->name}}">
                </div>
        
                <div class="form-group">
                    <span> Description </span>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"> {{$section->description}} </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section_id" id="section_id" value="{{$section->id}}">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</form>




@endsection