@extends('question-bank.index')

@section('sub_content')

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filterQuestion">
    Filter question
</button>

@if ($filters->type)
    @switch($filters->type)
        @case('mcq')
            <span class="badge badge-dark badge-pill">Multiple Choice</span>
            @break
        @case('tf')
            <span class="badge badge-dark badge-pill"> True or False </span>
            @break
        @case('sa')
            <span class="badge badge-dark badge-pill"> Identification </span>
            @break
        @case('essay')
            <span class="badge badge-dark badge-pill"> Essay </span>
            @break

        @default
    @endswitch
    
@endif

@if ($filters->subject)
    <span class="badge badge-dark badge-pill">{{$filters->subject->course_code}}  {{$filters->subject->name}}</span>
@endif

@if ($filters->start_date)
    <span class="badge badge-dark badge-pill"> Start: {{$filters->start_date}}</span>
@endif

@if ($filters->end_date)
    <span class="badge badge-dark badge-pill"> End: {{$filters->end_date}}</span>
@endif

@if ($filters->creator)
    <span class="badge badge-dark badge-pill"> Creator: {{$filters->creator->name}}</span>
@endif

@if($filters->type || $filters->subject || $filters->creator || $filters->start_date || $filters->end_date )
    <a href="{{route('question-bank.index')}}" class="text-danger"> <i class="fas fa-times-circle"></i> Clear Filters </a>
@endif




<!-- Modal -->
<div class="modal fade" id="filterQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" class="mt-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <span> Type </span>
                                    <select name="type" id="type" class="form-control">
                                        <option value=""> All Types </option>
                                        <option value="mcq" {{ $filters->type == 'mcq' ? 'selected' : null }} > Multiple Choice </option>
                                        <option value="tf" {{ $filters->type == 'tf' ? 'selected' : null }}> True or False </option>
                                        <option value="sa" {{ $filters->type == 'sa' ? 'selected' : null }}> Identification / Special Answer </option>
                                        <option value="essay" {{ $filters->type == 'essay' ? 'selected' : null }}> Essay </option>
                                    </select>
                                </div>
                              
                                <div class="form-group">
                                    <span> Start Date </span>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{$filters->start_date}}">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <span> Course </span>
                                    <select name="subject" id="subject" class="form-control">
                                        <option value=""> All Course </option>
                                        @foreach ($all_subjects as $subject)
                                            <option value="{{$subject->id}}"> {{$subject->course_code}}  {{$subject->name}}  </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span> End Date </span>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{$filters->end_date}}">
                                </div>
                                <div class="form-group">
                                    <span> Creator </span>
                                    <select name="creator" id="creator" class="form-control">
                                        <option value=""> All Creator </option>
                                        @foreach ($all_creators as $creator)
                                            <option value="{{$creator->user_creator->id}}"> {{$creator->user_creator->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                              
                            </div>
                        </div>
                        <hr>
                        <div class="text-right">
                            @if($filters->type || $filters->subject || $filters->creator || $filters->start_date || $filters->end_date )
                                <a href="{{route('question-bank.index')}}" class="btn btn-outline-secondary btn-sm "> Clear </a>
                            @endif
                            <button class="btn btn-primary btn-sm "> Filter Question </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
      
        </div>
      </div>
    </div>
  </div>
  
@if ($all_questions->count())
  <div class="mb-3 mt-3">Showing {{ $all_questions->firstItem() }} to {{ $all_questions->lastItem() }} of {{ $all_questions->total() }} questions </div>
@endif
<table class="table table-hover mt-3" style="font-size:14px; display: block ;
overflow-x: auto !important;
width: 100%; !important;">
    <thead>
        <th style="width:40%"> Question </th>
        <th style="width:10%" class="text-center"> Type </th>
        <th style="width:20%"> Course </th>
        <th style="width:10%"> Creator </th>
        <th> Creation Date </th>
        <th></th>
    </thead>
    <tbody>
        @forelse ($all_questions as $question)
            <tr>
                <td> 
                    <div id="q_instruction{{$question->id}}" class="q_instruction"> {!! $question->instruction !!}  </div>
                    <div id="full_q_instruction{{$question->id}}" class="full_q_instruction"></div> 

                    @if (strlen($question->instruction) >= 250)
                    <strong class="text-primary" id="btn-see-more{{$question->id}}" class="btn-see-more" style="cursor:pointer" onclick="showFullDescription({{$question}})"> See more </strong>
                    <strong class="text-primary" id="btn-see-less{{$question->id}}" class="btn-see-less" style="cursor:pointer;display:none" onclick="showLessDescription({{$question}})"> See Less </strong>
                    @endif
                </td>
                <td class="text-center"> <span class="badge badge-warning text-dark p-1 text-uppercase"> {{$question->question_type}} </span> </td>
                <td> {{$question->subject->course_code}} {{$question->subject->name}} </td>
                <td> {{$question->user_creator->name}} </td>
                <td> 
                    {{ $question->created_at->format('Y-m-d') }}
                </td>
                <td>
                    <a class="q_instruction btn btn-primary btn-sm" href="{{route('question-bank.show',$question)}}">
                        View
                    </a>  
                </td>
            </tr>
        @empty
            
        @endforelse
    </tbody>
</table>

<div class="text-right">
    {{ $all_questions->links() }}
</div>


{{-- @include('layouts.scripts') --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
    $(".q_instruction").text(function(index, currentText) {
        if(currentText.length >= 250){
            return currentText.substr(0, 250)+"...";
        }
    });

    function showFullDescription(question){
        $( "#btn-see-more"+question.id).hide();
        $( "#btn-see-less"+question.id).show();
        $( "#q_instruction"+question.id).empty();
        $('#full_q_instruction'+question.id).html(question.instruction)
    }

    function showLessDescription(question){
        $( "#btn-see-more"+question.id).show();
        $( "#btn-see-less"+question.id).hide();
        $("#q_instruction"+question.id).html(question.instruction)
        $("#q_instruction"+question.id).text(function(index, currentText) {
            return currentText.substr(0, 250)+"...";
        });
        $('#full_q_instruction'+question.id).empty()
    }

    </script>
@endsection

