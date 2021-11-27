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
            <input type="hidden" name="question_type" id="question_type" value="mcq">
            <strong class="text-muted"> Create New Question </strong> -  <span class="badge badge-warning text-dark p-1"> Multiple Choice </span>
            <hr>
            <div class="form-group mt-3">
                <small class="text-capitalize"> Subject </small>
                <select name="subject" id="subject" class="form-control" required>
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}"> {{$subject->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <span> <i class="fas fa-question-circle"></i> Instruction </span>
                <textarea name="instruction" id="instruction" cols="30" rows="10" class="instruction mt-3"></textarea>
            </div>
    
            <div class="form-group mt-3">
                <span> <i class="fas fa-paperclip"></i> Attachment </span> <br>
                <input type="file" name="attachment" id="attachment" class="mt-3">
            </div>
    
            <div class="mt-5"> 
                <span> <i class="fas fa-align-left"></i> Options  </span> (Fill up atleast 2 options) <br>
                <div class="form-group mt-3">
                    <strong> Option A </strong> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="correct_answer" value="a"  checked > 
                        <label class="form-check-label" for="exampleRadios1">
                          Correct Answer
                        </label>
                    </div>
                    <br>
                    <textarea name="option_1" id="" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group mt-3">
                    <strong> Option B </strong> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="correct_answer" value="b">
                        <label class="form-check-label" for="exampleRadios1">
                          Correct Answer
                        </label>
                    </div>
                    <br>
                    <textarea name="option_2" id="" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group mt-3">
                    <strong> Option C </strong> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="correct_answer" value="c"  >
                        <label class="form-check-label" for="exampleRadios1">
                          Correct Answer
                        </label>
                    </div>
                    <br>
                    <textarea name="option_3" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group mt-3">
                    <strong> Option D </strong> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="correct_answer" value="d" >
                        <label class="form-check-label" for="exampleRadios1">
                          Correct Answer
                        </label>
                    </div>
                    <br>
                    <textarea name="option_4" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group mt-3">
                    <strong> Option E </strong> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="correct_answer" value="e"  >
                        <label class="form-check-label" for="exampleRadios1">
                          Correct Answer
                        </label>
                    </div>
                    <br>
                    <textarea name="option_5" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group mt-3">
                    <strong> Option F </strong> 
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="correct_answer" value="f" >
                        <label class="form-check-label" for="exampleRadios1">
                          Correct Answer
                        </label>
                    </div>
                    <br>
                    <textarea name="option_6" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div> 
    
            <div>
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


