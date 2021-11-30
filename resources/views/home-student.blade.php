@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-tachometer-alt text-info"></i>  Dashboard </h4>
        <small class="text-muted"> <i> Summary of contents </i>  </small>
    </div>
</div>

@if (Auth::user()->user_instance->role_id == 3)
<div class="card shadow-sm mt-3">
    <div class="card-body">
         Welcome <strong> {{Auth::user()->name}} </strong>! 
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-shapes"></i> Recently Assigned Modules 
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <th> Module </th>
                        <th> Group </th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($all_modules as $module)
                            <tr>
                                <td> 
                                    {!! $module->exam ? '<i class="fas fa-copy text-primary"></i> '.$module->exam->name : null !!}  
                                    {!! $module->discussion ? '<i class="fas fa-comment text-success"></i> '.$module->discussion->name : null !!}  
                                    {!! $module->learning_material ? '<i class="fas fa-file-signature text-warning"></i> '.$module->learning_material->name : null !!}  
                                    {!! $module->link ? '<i class="fas fa-link text-danger"></i>'.$module->link->name : null !!}  
                                </td>
                                <td>
                                    {{$module->exam ? $module->exam->group->name : null}}  
                                    {{$module->discussion ? $module->discussion->group->name : null}}  
                                    {{$module->learning_material ? $module->learning_material->group->name : null}}  
                                    {{$module->link ? $module->link->group->name : null}}  
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{route('groups.user-group.list-exam',$module->group_id)}}" {{$module->exam ? $module->exam->group->name : 'hidden'}}> <i class="fas fa-align-left"></i> Open List </a> 
                                    <a class="btn btn-sm btn-info" href="{{route('groups.user-group.list-discussion',$module->group_id)}}" {{$module->discussion ? $module->discussion->group->name : 'hidden'}} > <i class="fas fa-align-left"></i> Open List </a>
                                    <a class="btn btn-sm btn-info" href="{{route('groups.user-group.list-learning-material',$module->group_id)}}" {{$module->learning_material ? $module->learning_material->group->name : 'hidden'}}> <i class="fas fa-align-left"></i> Open List </a>
                                    <a class="btn btn-sm btn-info" href="{{route('groups.user-group.list-link',$module->group_id)}}" {{$module->link ? $module->link->group->name : 'hidden'}}> <i class="fas fa-align-left"></i> Open List </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-cubes"></i> My Groups
            </div>
            <div class="card-body">
                @forelse ($my_group_assignments as $group_assignment)
                    <a href="{{route('groups.user-group.list-exam',$group_assignment->group_id)}}" class="text-info" style="text-decoration: none;">
                        <div class="card mt-2">
                            <div class="card-body">
                                <i class="fas fa-cube"></i> {{$group_assignment->group->name}}
                            </div>
                        </div>
                    </a>
                @empty
                    <div>
                        No groups assigned
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>



@endif



<style>
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeInDown {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  }
  @keyframes fadeInDown {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  } 


  .fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
  }
  @keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
  } 
</style>



@include('layouts.scripts')

<script></script>

@endsection
