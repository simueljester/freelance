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
                <div> <i class="fas fa-shapes text-primary"></i> <small> Modules created </small> </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$group_count}} </strong> </div>
                <div> <i class="fas fa-cubes text-primary"></i>  <small> Class created </small> </div>
            </div>
        </div>
    </div>
   
    <div class="col-sm-4">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px; ">  {{$question_count}}  </strong> </div>
                <div> <i class="fas fa-question-circle text-primary"></i> <small> Questions created </small> </div>
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
                <a href="{{route('question-bank.create.mcq',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create Multiple Choice Question </a>
                <a href="{{route('question-bank.create.tf',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create True or False Question </a>
                <a href="{{route('question-bank.create.sa',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create Identification Question </a>
                <a href="{{route('question-bank.create.essay',0)}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create Essay Question </a>
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
