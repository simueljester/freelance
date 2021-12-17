@extends('question-bank.index')

@section('sub_content')


<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filterQuestion">
    Filter question
</button>

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
                                    <span> Difficulty </span>
                                    <select name="difficulty" id="difficulty" class="form-control">
                                        <option value=""> All Difficulty </option>
                                        <option value="1" {{ $filters->difficulty == 1 ? 'selected' : null }} > Easy </option>
                                        <option value="2" {{ $filters->difficulty == 2 ? 'selected' : null }} > Medium </option>
                                        <option value="3" {{ $filters->difficulty == 3 ? 'selected' : null }} > Hard </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span> Start Date </span>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{$filters->start_date}}">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <span> Subject </span>
                                    <select name="subject" id="subject" class="form-control">
                                        <option value=""> All Subjects </option>
                                        @foreach ($all_subjects as $subject)
                                            <option value="{{$subject->id}}" {{ $filters->subject == $subject->id ? 'selected' : null }}> {{$subject->course_code}}  {{$subject->name}}  </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <span> Creator </span>
                                    <select name="creator" id="creator" class="form-control" disabled>
                                        <option value=""> All Creator </option>
                                        @foreach ($all_creators as $creator)
                                            <option  selected> {{Auth::user()->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span> End Date </span>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{$filters->end_date}}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($filters->type || $filters->subject || $filters->difficulty || $filters->creator || $filters->start_date || $filters->end_date )
                            <a href="{{route('question-bank.index')}}" class="btn btn-outline-secondary btn-sm"> Clear </a>
                        @endif
                        <button class="btn btn-primary btn-sm"> Filter Question </button>
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
        <th style="width:20%"> Subject </th>
        {{-- <th style="width:10%"> Difficulty </th> --}}
        <th style="width:10%"> Creator </th>
        <th> Creation Date </th>
    </thead>
    <tbody>
        @forelse ($all_questions as $question)
            <tr>
                <td> <a href="{{route('question-bank.show',$question)}}"> {!! $question->instruction !!} </a>  </td>
                <td class="text-center"> <span class="badge badge-warning text-dark p-1 text-uppercase"> {{$question->question_type}} </span> </td>
                <td> {{$question->subject->course_code}} {{$question->subject->name}} </td>
                {{-- <td>  
                    @if ($question->level == 1)
                        <span class="text-success"> Easy </span>
                    @endif
                    @if ($question->level == 2)
                        <span class="text-primary"> Medium </span>
                    @endif
                    @if ($question->level == 3)
                        <span class="text-danger"> Hard </span>
                    @endif
                </td> --}}
                <td> {{$question->user_creator->name}} </td>
                <td> 
                    {{ $question->created_at->format('Y-m-d') }}
                </td>
            </tr>
        @empty
            
        @endforelse
    </tbody>
</table>

<div>
    {{ $all_questions->links() }}
</div>

@endsection

