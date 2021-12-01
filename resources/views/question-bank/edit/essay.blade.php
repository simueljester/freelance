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
            <li class="breadcrumb-item active" aria-current="page"> Edit Question </li>
        </ol>
    </nav>
</div>


<form action="{{route('question-bank.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <input type="hidden" name="question_type" id="question_type" value="essay">
            <input type="hidden" name="question_id" id="question_id" value="{{$question->id}}">

            <strong class="text-muted"> Edit Question </strong> -  <span class="badge badge-warning text-dark p-1"> Essay </span>
            <hr>
            <div class="form-group mt-3">
                <small class="text-capitalize"> Difficulty Level </small>
                <select name="difficulty" id="difficulty" class="form-control"  required>
                    <option value="1" {{$question->level == 1 ? 'selected' : null}}> Easy </option>
                    <option value="2" {{$question->level == 2 ? 'selected' : null}}> Medium </option>
                    <option value="3" {{$question->level == 3 ? 'selected' : null}}> Hard </option>
                </select>
            </div>
            <div class="form-group mt-3">
                <span> <i class="fas fa-question-circle"></i>  Instruction </span>
                <textarea name="instruction" id="instruction" cols="30" rows="10" class="instruction"> {!! $question->instruction !!} </textarea>
            </div>

            <div class="form-group mt-3">
                <span> <i class="fas fa-paperclip"></i> Attachment </span>
                @if ($question->attachment)
                - <a href="{{route('downloads.question-attachment',$question->attachment)}}" class="text-info"> {{$question->attachment}} </a>
                @endif
                <br>
                <input type="file" name="attachment" id="attachment" class="mt-3">
                <input type="hidden" name="old_attachment" id="old_attachment" value="{{$question->attachment}}">
            </div>

            <div class="mt-5">
                
                <div class="form-group mt-3">
                    <span>  Maximum points </span> - <small> Set maximum points then set points after reviewing the exam </small>
                    <br>
                    <input type="number" name="max_points" id="max_points" max="100" min="1" class="form-control" value="{{$question->max_points}}" required>
                </div>

            </div>
            
            <div class="mt-5">
                <a href="{{route('question-bank.index')}}" class="btn btn-outline-secondary"> Cancel </a>
                <button class="btn btn-info"> Save Question</button>
            </div>
        </div>
    </div>
</form>

@include('layouts.scripts') 

<script>
  
    $('.instruction').each( function () {
        // var editor =  CKEDITOR.replace( this.id  )
        var editor = CKEDITOR.replace( this.id, {
            language: 'en',
            extraPlugins: 'notification'
        });

        editor.on( 'required', function( evt ) {
            editor.showNotification( 'This field is required.', 'warning' );
        evt.cancel();
        });
    });

</script>
@endsection


