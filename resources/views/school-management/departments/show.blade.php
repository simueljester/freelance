@extends('school-management.index')

@section('sub-content')

<div class="p-2">
  <h5 class="text-muted"> <strong> {{$department->name}} </strong> </h5> 
  <small> {{$department->description}} </small>
  <hr>
  <a href="{{route('school-management.departments.index')}}" class="text-muted"> <i class="far fa-arrow-alt-circle-left"></i> Back </a>
  &nbsp&nbsp
  <span class="text-primary" data-toggle="modal" data-target="#editDepartment" style="cursor:pointer;"> <i class="fas fa-edit"></i> Edit </span>
  &nbsp&nbsp
  <a href="{{route('school-management.departments.delete',$department)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this department?')"> <i class="fas fa-trash-alt"></i> Delete </a>
  &nbsp&nbsp
  Date Created: {{$department->created_at->format('Y-m-d')}} 
</div>

<div class="bg-light mt-3 p-3 border rounded">
  <strong class="text-muted"> Sections Created </strong>
 
  <table class="table table-hover">
    <thead>
        <th> Name </th>
        <th> Creation Date </th>
    </thead>
    <tbody>
      @foreach ($department->sections as $section)
      <tr>
        <td>  
          <a href="{{route('school-management.sections.show',$section)}}" style="text-decoration: none">
            <i class="fas fa-users"></i> {{$section->name}}
          </a>
        </td>
        <td> {{$section->created_at->format('Y-m-d')}} </td>
      </tr>
      @endforeach
      <tr style="cursor: pointer" data-toggle="modal" data-target="#createSection">
        <td colspan="2"> <span class="text-primary" > <i class="fas fa-plus"></i> Add New Section </span> </td>
      </tr>
    </tbody>
  </table>
  


</div>

<!-- Modal for create section -->
<form action="{{route('school-management.sections.save')}}" method="POST">
  @csrf
  @method("POST")
  <div class="modal fade" id="createSection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Create Section </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="form-group">
                  <span> Name </span>
                  <input type="text" name="section_name" id="section_name" class="form-control" required>
              </div>
          
              <div class="form-group">
                  <span> Description (optional) </span>
                  <textarea name="section_description" id="section_description" cols="30" rows="10" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <span> Department</span>
                <select name="department" id="department" class="form-control" required>
                  <option value="{{$department->id}}"> {{$department->name}} </option>
                </select>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary"> Create Section </button>
        </div>
      </div>
    </div>
  </div>
</form>




<!-- Modal for Edit-->
<form action="{{route('school-management.departments.update')}}" method="POST">
    @csrf
    @method("POST")
    <div class="modal fade" id="editDepartment" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Edit {{$department->name}} </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span> Name </span>
                    <input type="text" name="name" id="name" class="form-control" value="{{$department->name}}">
                </div>
        
                <div class="form-group">
                    <span> Description </span>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"> {{$department->description}} </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="department_id" id="department_id" value="{{$department->id}}">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</form>




@endsection
