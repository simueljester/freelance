@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">  <i class="fas fa-globe text-primary"></i> Question Bank  </h4>
        <small class="text-muted"> <i> Manage questions </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('question-bank.index')}}"> Question Bank</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Check Question Uploads </li>
        </ol>
    </nav>
</div>


<form action="{{route('question-bank.save-batch-upload')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    
        @foreach ($uploaded_questions as $key => $question)
            <div class="card shadow-sm mt-3">
                <div class="card-header">
                    <strong> Question uploaded {{$key + 1}} - <span class="text-uppercase"> {{$question['question_type']}} </span> </strong>
                </div>
                <div class="card-body">
                    {{$question['instruction']}}
                    <hr>
                    @if ($question['question_type'] == 'mcq' || $question['question_type'] == 'tf')
                        <div class="p-3 border mt-3 rounded">
                            <strong> Options </strong>
                            <ol type="a">
                                @if ($question['option_1'])
                                    <li> {{$question['option_1']}} </li>
                                @endif
                                @if ($question['option_2'])
                                    <li> {{$question['option_2']}} </li>
                                @endif
                                @if ($question['option_3'])
                                    <li> {{$question['option_3']}} </li>
                                @endif
                                @if ($question['option_4'])
                                    <li> {{$question['option_4']}} </li>
                                @endif
                                @if ($question['option_5'])
                                    <li> {{$question['option_5']}} </li>
                                @endif
                                @if ($question['option_6'])
                                    <li> {{$question['option_6']}} </li>
                                @endif
                            </ol>
                        </div>
                    @endif
                    <div class="p-3 border mt-3 rounded">
                        <strong> Correct Answer : </strong>
                        {{$question['correct_answer'] ?? 'Not Available'}}
                    </div>
                </div>
            </div>
        @endforeach
          
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    <i class="fas fa-primary-circle"></i> These questions will be assigned to <strong> Default Subject </strong>. Admin / Teacher my update subject assignments of these questions after import.
                  </div>

                <br>
                <input type="hidden" name="uploaded_questions" id="uploaded_questions" value="{{json_encode($uploaded_questions)}}">
                <a href="{{route('question-bank.index')}}" class="btn btn-outline-secondary"> Cancel </a>
                <button class="btn btn-primary"> Import Questions </button>
            </div>
        </div>
        

</form>

@include('layouts.scripts') 

<script>
  
 

</script>
@endsection


