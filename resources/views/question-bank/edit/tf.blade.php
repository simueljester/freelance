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
            <li class="breadcrumb-item active" aria-current="page"> Update Question </li>
        </ol>
    </nav>
</div>


<form action="{{route('question-bank.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <input type="hidden" name="question_id" id="question_id" value="{{$question->id}}">
            <input type="hidden" name="question_type" id="question_type" value="tf">

            <strong class="text-muted"> Update Question </strong> -  <span class="badge badge-warning text-dark p-1"> True or False </span>
            <hr>
            <div class="row">
                <div class="col-sm-12"> 
                    <div class="form-group mt-3">
                        <small class="text-capitalize"> Course </small>
                        <select name="subject" id="subject" class="form-control" required>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}" {{$question->subject_id == $subject->id ? 'selected' : null}}> {{$subject->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-sm-6"> 
                    <div class="form-group mt-3">
                        <small class="text-capitalize"> Difficulty Level </small>
                        <select name="difficulty" id="difficulty" class="form-control"  required>
                            <option value="1" {{$question->level == 1 ? 'selected' : null}}> Easy </option>
                            <option value="2" {{$question->level == 2 ? 'selected' : null}}> Medium </option>
                            <option value="3" {{$question->level == 3 ? 'selected' : null}}> Hard </option>
                        </select>
                    </div>
                </div> --}}
            </div>
            <div class="form-group mt-3">
                <span> <i class="fas fa-question-circle"></i>  Instruction </span>
                <textarea name="instruction" id="instruction" cols="30" rows="10" class="instruction">  {!! $question->instruction !!}  </textarea>
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
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_answer" value="true"  {{$question->answer == 'true' ? 'checked' : ''}}  required> 
                    <input type="hidden" name="option_1" id="option_1" value="true">
                    <label class="form-check-label" for="exampleRadios1">
                      True
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_answer" value="false" {{$question->answer == 'false' ? 'checked' : ''}}  required> 
                    <input type="hidden" name="option_2" id="option_2" value="false">
                    <label class="form-check-label" for="exampleRadios1">
                      False
                    </label>
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


