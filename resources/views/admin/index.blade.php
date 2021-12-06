@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-user-cog text-primary"></i>  Administrator </h4>
        <small class="text-muted"> <i> Access / Manage reports, logins and user accounts as system adminstrator </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Administrator</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-sm-3">
        <a href="{{route('administrator.logins.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-sign-in-alt fa-3x text-primary"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> Login Report </strong> 
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="{{route('administrator.system-logs.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-layer-group fa-3x text-primary"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> System Logs  </strong> 
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="{{route('user-management.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-primary"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> User Management </strong> 
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="{{route('administrator.exports.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-cloud-download-alt  fa-3x text-primary"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> Exports </strong> 
                </div>
            </div>
        </a>
    </div>
</div>


    <div class="card shadow-sm mt-3">
        <div class="card-body">
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
                                    <a href="{{route('administrator.change-academic-active',$ac)}}" class="btn btn-primary btn-sm"> Set as active </a>
                                @else
                                    <strong class="text-success"> Active </strong>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <form action="{{route('administrator.save-academic-year')}}" method="POST">
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
                        <span> Name </span>
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
