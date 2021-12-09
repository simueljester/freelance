@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-paste text-white text-info"></i>  Examination  </h4>
        <small class="text-muted"> <i> Manages examination details, assignment, questions and settings </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$exam->group)}}"> {{$exam->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('groups.exam.show',$exam)}}"> {{$exam->name}} </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit</li>

    
        </ol>
    </nav>
</div>


<form action="{{route('groups.exam.examination-assignment.assign-questions')}}" method="POST">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h5 class="text-muted"> Assign Questions to <strong> {{$exam->name}} </strong>  </h5>
            <small> {{$exam->description}} </small>
        
            <div class="mt-4">
                <button class="btn btn-info btn-sm"> Assign Selected Questions </button>
                <a href="{{route('groups.exam.show',$exam)}}" class="btn btn-outline-secondary btn-sm"> Cancel </a>
            </div>
            <table class="table table-hover mt-3">
                <thead>
                    <th style="width:60%"> Question </th>
                    <th style="width:10%"> Difficulty </th>
                    <th style="width:10%"> Type </th>
                    <th style="width:10%"> Subject </th>
                    <th style="width:10%">  </th>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td> <a href="{{route('question-bank.show',$question)}}" class="text-info"> {!!$question->instruction!!} </a>  </td>
                            <td>
                                @if ($question->level == 1)
                                    <span class="text-success"> Easy </span>
                                @endif
                                @if ($question->level == 2)
                                    <span class="text-primary"> Medium </span>
                                @endif
                                @if ($question->level == 3)
                                    <span class="text-danger"> Hard </span>
                                @endif
                            </td>
                            <td class="text-uppercase"> <small> {{ $question->question_type }} </small>  </td>
                            <td> {{$question->subject->name}} </td>
                            <td>
                                @if(in_array($question->id, $assigned_questions))
                                    <h6><span class="badge badge-success"> Assigned </span></h6>
                                @else
                                   
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_ids[]" value="{{$question->id}}" id="defaultCheck1">
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                <input type="hidden" name="exam_id" id="exam_id" value="{{$exam->id}}">
           
                {{-- <button class="btn btn-info btn-sm"> Assign Selected Questions </button>
                <a href="{{route('groups.exam.show',$exam)}}" class="btn btn-outline-secondary btn-sm"> Cancel </a> --}}
            </div>
        </div>
    </div>
</form>

@endsection
