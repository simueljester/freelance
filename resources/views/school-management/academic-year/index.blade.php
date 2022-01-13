@extends('school-management.index')
@section('sub-content')
<div>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-plus"></i> Add Academic Year
    </button>
    
    <div class="card mt-3">
        <div class="card-header">
            <strong class="text-success"> Active Academic Year </strong>
        </div>
        <div class="card-body text-capitalize ">
            <strong> {{$active_academic_year->name}} - {{$active_academic_year->year}} - {{$active_academic_year->semester}} </strong> 
        </div>
    </div>

    <ul class="nav nav-tabs mb-3 mt-3">
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'current' ? 'active' : '' }}"  href="?tab=current">Current</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'archive' ? 'active' : '' }}" href="?tab=archive">Archived</a>
        </li>
    </ul>
    
    <table class="table table-hover mt-3 ">
        <thead>
            <th> Name </th>
            <th> Year </th>
            <th> Semester </th>
            <th> Active </th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($academic_years as $ac)
                <tr class="{{$ac->active == 1 ? 'bg-white  text-dark font-weight-bold' : 'bg-light'}}  ">
                    <td> {{$ac->name}} </td>
                    <td> {{$ac->year}} </td>
                    <td> {{$ac->semester}} </td>
                    <td> 
                        @if ($ac->active != 1)
                            @if ($tab == 'current')
                                <a href="{{route('school-management.academic-year.change-academic-active',$ac)}}" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to make this Academic Year active?')"> Set as active </a>
                            @endif
                            
                        @else
                            <strong class="text-success"> Active </strong>
                        @endif
                    </td>
                    <td> 
                        @if ($tab == 'current')
                            @if ($ac->active != 1)
                                <form action="{{route('school-management.academic-year.archive-academic-year')}}" method="POST">
                                @csrf
                                @method('POST')
                                    <input type="hidden" name="ac_id" id="ac_id" value="{{$ac->id}}">
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive this Academic Year?')"> <i class="fas fa-archive"></i> Archive </button>
                                </form>
                            @endif
                        @endif

                        @if ($tab == 'archive')
                        <form action="{{route('school-management.academic-year.restore-academic-year')}}" method="POST">
                            @csrf
                            @method('POST')
                                <input type="hidden" name="ac_id" id="ac_id" value="{{$ac->id}}">
                                <button class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to restore this Academic Year from archived?')">  Restore </button>
                        </form>
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
                    <span> Name (Unique) </span> <span class="text-danger"> * </span>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <span> Year </span> <span class="text-danger"> * </span>
                    <input type="text" name="year" id="year" class="form-control" required>
                </div>
                <div class="form-group">
                    <span> Semester </span> <span class="text-danger"> * </span>
                    <select name="semester" id="semester" class="form-control" required>
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