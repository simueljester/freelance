@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Class  </h4>
        <small class="text-muted"> <i> Class Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('groups.user-group.user-group')}}">Class</a> </li>
            <li class="breadcrumb-item"> {{$group->name}} </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> <strong> <i class="fas fa-cube text-primary"></i> {{$group->name}} </strong> </h5>
        <small> {{$group->description}} </small>
        <hr>
        <div> Instructor: {{$group->user_creator->name}} </div>
        <div> Date Created: {{$group->created_at->format('Y-m-d')}} </div>
        <div class="mt-3">  
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                View Grades
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#showOtherEnrolled">
                Class List
            </button>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <strong> {{$group->name}} Course Requirements </strong>
        <ul class="nav nav-tabs mt-3" role="tablist">
       
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-exam') ? 'active' : ''}}" href="{{route('groups.user-group.list-exam',$group)}}" > <i class="fas fa-copy text-primary"></i> Assessments </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-link') ? 'active' : ''}}" href="{{route('groups.user-group.list-link',$group)}}" > <i class="fas fa-link text-danger"></i> Links </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-learning-material') ? 'active' : ''}}" href="{{route('groups.user-group.list-learning-material',$group)}}" > <i class="fas fa-file-signature text-warning"></i> Learning Materials </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('groups.user-group.list-discussion') ? 'active' : ''}}" href="{{route('groups.user-group.list-discussion',$group)}}" > <i class="fas fa-comment text-success"></i>  Discussions </a>
            </li>
          
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content border p-3 bg-light">
            @yield('sub_content')
          </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> My {{$group->name}} Grades </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-hover">
                <thead>
                    <th> Term </th>
                    <th> Grade </th>
                </thead>
                <tbody>
                    @foreach ($my_grade as $grade)
                        <tr>
                            <td class="text-uppercase"> {{$grade->term}} </td>
                            <td> {{$grade->final_grade}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal -->
<div class="modal fade" id="showOtherEnrolled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Class List </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul>
                @foreach ($group->members as $group_assignment)
                    <li class="text-uppercase"> <i class="fas fa-user"></i> {{$group_assignment->user->name}} </li>
                @endforeach
            </ul>
        </div>
        <div class="modal-footer">
    
        </div>
      </div>
    </div>
  </div>



@endsection
