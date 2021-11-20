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
            <li class="breadcrumb-item active" aria-current="page">Create New Question </li>
        </ol>
    </nav>
</div>


<form action="{{route('question-bank.save')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <input type="hidden" name="question_type" id="question_type" value="tf">

            <strong class="text-muted"> Create New Question </strong> -  <span class="badge badge-warning text-dark p-1"> True or False </span>
            <hr>
            <div class="form-group mt-3">
                <span> <i class="fas fa-question-circle"></i>  Instruction </span>
                <textarea name="instruction" id="instruction" cols="30" rows="10" class="instruction"></textarea>
            </div>

            <div class="form-group mt-3">
                <span> <i class="fas fa-paperclip"></i> Attachment </span> <br>
                <input type="file" name="attachment" id="attachment" class="mt-3">
            </div>

            <div class="mt-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_answer" value="true"  checked required> 
                    <input type="hidden" name="option_1" id="option_1" value="true">
                    <label class="form-check-label" for="exampleRadios1">
                      True
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_answer" value="false" required> 
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


