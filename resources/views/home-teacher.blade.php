@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-tachometer-alt text-primary"></i>  Dashboard </h4>
        <small class="text-muted"> <i> Summary of contents </i>  </small>
    </div>
</div>

@if (Auth::user()->user_instance->role_id == 2)
<div class="row">

    <div class="col-sm-4">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$module_count}} </strong> </div>
                <div> <i class="fas fa-shapes text-primary"></i> <strong> <a href="{{route('groups.index')}}"> Modules Created  </a> </strong> </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$group_count}} </strong> </div>
                <div> <i class="fas fa-cubes text-primary"></i> <strong> <a href="{{route('groups.index')}}"> Class Created  </a> </strong> </div>
            </div>
        </div>
    </div>
   
    <div class="col-sm-4">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px; ">  {{$question_count}}  </strong> </div>
                <div> <i class="fas fa-question-circle text-primary"></i> <strong> <a href="{{route('question-bank.index')}}"> Questions Created  </a> </strong> </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-dark text-white">
                <i class="far fa-question-circle"></i> Recently Created Questions 
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <th> Question </th>
                        <th> Subject </th>
                    </thead>
                    <tbody>
                        @foreach ($recently_created_questions as $question)
                        <tr>
                            <td> <a class="text-primary" style="text-decoration: none;" href="{{route('question-bank.show',$question)}}"> {!! $question->instruction !!} </a>  </td>
                            <td> {{$question->subject->name}} </td>
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
                <i class="far fa-plus-square"></i> Create Shortcut 
            </div>
            <div class="card-body">
                <a href="{{route('groups.create')}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i> Create New Class </a>
                <div class="dropdown mt-2 w-100">
                    <button class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create New Question </button>
                    <div class="dropdown-content">
                        <a class="dropdown-item" href="{{route('question-bank.create.mcq',0)}}"> Add Multiple Choice</a>
                        <a class="dropdown-item" href="{{route('question-bank.create.tf',0)}}"> Add True or False</a>
                        <a class="dropdown-item" href="{{route('question-bank.create.sa',0)}}"> Add Identification </a>
                        <a class="dropdown-item" href="{{route('question-bank.create.essay',0)}}"> Add Essay </a>
                    </div>
                </div>
                
                {{-- <a href="{{route('question-bank.create.mcq',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create Multiple Choice Question </a>
                <a href="{{route('question-bank.create.tf',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create True or False Question </a>
                <a href="{{route('question-bank.create.sa',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create Identification Question </a>
                <a href="{{route('question-bank.create.essay',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create Essay Question </a> --}}
                <button  class="btn btn-primary btn-block text-left mt-2" data-toggle="modal" data-target="#createExam"> <i class="fas fa-plus"></i>  Create New Exam </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->

<div class="modal fade" id="createExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Create Exam </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <span> Select Folder </span>
                <ul>
                    @forelse ($folders as $folder)
                        <li> <a href="{{route('groups.exam.create',[$folder->group,$folder->id ?? 0])}}" style="text-decoration: none;">  {{$folder->group->name}} / <i class="fas fa-folder"></i> {{$folder->name}}  </a> </li> 
                    @empty
                        No folder found 
                    @endforelse
                </ul>
              </select>
          </div>
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
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

  .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>



@include('layouts.scripts')

<script></script>

@endsection
