@extends('school-management.index')
@section('sub-content')
<div>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-plus"></i> Add Academic Year
      </button>
      
    <table class="table table-hover mt-3 ">
        <thead>
            <th> Name </th>
            <th> Year </th>
            <th> Semester </th>
            <th> Active </th>
        </thead>
        <tbody>
            @foreach ($academic_years as $ac)
                <tr class="{{$ac->active == 1 ? 'bg-white  text-dark font-weight-bold' : 'bg-light'}}  ">
                    <td> {{$ac->name}} </td>
                    <td> {{$ac->year}} </td>
                    <td> {{$ac->semester}} </td>
                    <td> 
                        @if ($ac->active != 1)
                            <a href="{{route('school-management.academic-year.change-academic-active',$ac)}}" class="btn btn-primary btn-sm"> Set as active </a>
                        @else
                            <strong class="text-success"> Active </strong>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<form action="{{route('school-management.academic-year.save-academic-year')}}" method="POST">
    @csrf
    @method('POST')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Add Academic Year </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span> Name (Unique) </span>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <span> Year </span>
                    <input type="text" name="year" id="year" class="form-control" required>
                </div>
                <div class="form-group">
                    <span> Semester </span>
                    <select name="semester" id="semester" class="form-control">
                        <option value="1st semester"> 1st Semester </option>
                        <option value="2nd semester"> 2nd Semester </option>
                        <option value="summer"> Summer </option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm"> Save Academic Year </button>
            </div>
        </div>
        </div>
    </div>

</form>
@endsection