@extends('school-management.index')

@section('sub-content')


<div class="row">
    <div class="col-sm-6">
        <a href="{{route('school-management.subjects.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Subject </a>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filterDepartment">
            Filter Department
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#batchUploadSubject">
            Batch Upload
        </button>
    </div>
    <div class="col-sm-6">
        <form action="">
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Keyword.." aria-describedby="button-addon2" value="{{$keyword}}">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
            @if ($keyword)
                <a href="{{route('school-management.subjects.index')}}" class="btn btn-outline-secondary btn-sm "> Clear keyword </a>  
            @endif
        </form>
    </div>
</div>   

<div class="mt-4">
    @if ($subjects->count())
        <div class="mb-3">Showing {{ $subjects->firstItem() }} to {{ $subjects->lastItem() }} of {{ $subjects->total() }} subjects </div>
    @endif
    <table class="table table-hover">
        <thead>
            <th> Subjects / Course Code </th>
            <th> Descriptive Title </th>
            <th> Department </th>
            <th> Academic Year </th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td class="text-capitalize"> {{$subject->course_code}} </td>
                    <td> {{$subject->name}}  </td>
                    <td> {{$subject->department->name}} </td>
                    <td> {{$subject->activeAcademicYear->name}} </td>
                    <td> <a href="{{route('school-management.subjects.show',$subject)}}" class="btn btn-primary btn-sm">  View </a> </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> <strong> No subjects created </strong> </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $subjects->links() }}

</div>

<!-- Modal -->

<form action="{{route('school-management.subjects.save-batch-upload')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade" id="batchUploadSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Batch Upload </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <a href="{{route('downloads.template','subject_template.xlsx')}}"> <i class="fas fa-download"></i> Download Template </a>
                    <div class="form-group mt-3">
                        <span> Department</span> <span class="text-danger"> * </span>
                        <select name="department" id="department" class="form-control" required>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}" {{$department->id == $department_filter ? 'selected' : null}}> {{$department->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <span> File </span><br>
                        <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv"  required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary"> Upload </button>
                </div>
            </div>
        </div>
    </div>
</form>


<form action="">
    <div class="modal fade" id="filterDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Filter Department </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span> Department</span> <span class="text-danger"> * </span>
                    <select name="department_filter" id="department_filter" class="form-control" required>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}" {{$department->id == $department_filter ? 'selected' : null}}> {{$department->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary"> Filter </button>
            </div>
          </div>
        </div>
      </div>
</form>



@endsection
