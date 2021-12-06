@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">  <i class="fas fa-globe text-info"></i> Question Bank  </h4>
        <small class="text-muted"> <i> Manage questions </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('question-bank.index')}}"> Question Bank</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Show Question </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <div class="p-3 border rounded">
            <strong> Instruction - </strong> <span class="badge badge-warning text-dark p-1 text-uppercase"> {{$question->question_type}} </span>
            <p class="mt-3"> {!! $question->instruction !!} </p>
            <hr>
            <small> <i class="fas fa-book-reader"></i> {{$question->subject->course_code}} {{$question->subject->name}} </small>
          
            &nbsp&nbsp&nbsp
            @if ($question->level == 1)
                <small class="text-success"> Easy </small>
            @endif
            @if ($question->level == 2)
                <small class="text-primary"> Medium </small>
            @endif
            @if ($question->level == 3)
                <small class="text-danger"> Hard </small>
            @endif
            &nbsp&nbsp&nbsp
            <small> <i class="fas fa-circle"></i>  Points: {{$question->max_points}}</small>
            &nbsp&nbsp&nbsp
            <small> <i class="fas fa-user"></i> Created By: {{$question->user_creator->name}}</small>
            &nbsp&nbsp&nbsp
            <small> <i class="far fa-calendar-alt"></i> Date Created: {{$question->created_at->format('Y-m-d')}} </small>
            &nbsp&nbsp&nbsp
            @if ($question->attachment)
                <a href="{{route('downloads.question-attachment',$question->attachment)}}" class="text-info"> <i class="fas fa-download"></i> Download Attached File </a>
            @endif
        </div>

        @if ($question->question_type == 'mcq' || $question->question_type == 'tf')
            <div class="p-3 border mt-3 rounded">
                <strong> Options </strong>
                <ol type="a">
                    @if ($question->option_1)
                        <li> {{$question->option_1}} </li>
                    @endif
                    @if ($question->option_2)
                        <li> {{$question->option_2}} </li>
                    @endif
                    @if ($question->option_3)
                        <li> {{$question->option_3}} </li>
                    @endif
                    @if ($question->option_4)
                        <li> {{$question->option_4}} </li>
                    @endif
                    @if ($question->option_5)
                        <li> {{$question->option_5}} </li>
                    @endif
                    @if ($question->option_6)
                        <li> {{$question->option_6}} </li>
                    @endif
                </ol>
            </div>
        @endif

        <div class="p-3 border mt-3 rounded">
            <strong> Correct Answer : </strong>
            {{$question->answer ?? 'Not Available'}}
        </div>
    </div>
</div>


<div class="card shadow-sm mt-3">
    <div class="card-body">
        <a href="{{route('question-bank.edit',$question)}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> Edit Question </a>
        <a href="{{route('question-bank.delete',$question)}}" onclick="return confirm('Are you sure you want to delete this question?')" class="btn btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"></i> Delete Question </a>
        <a href="{{route('question-bank.index')}}" class="btn btn-outline-secondary btn-sm"> Back to List </a>
        
    </div>
</div>




@endsection
