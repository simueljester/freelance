@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Class  </h4>
        <small class="text-muted"> <i> Class Assignments </i>  </small>
    </div>
</div>


<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Class</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$exam->group)}}"> {{$exam->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('groups.exam.show',$exam)}}"> {{$exam->name}} </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Exam Questions Analysis </li>

        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header text-white" style="background: #081127" c>
        <strong> Table View </strong>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm ">
            <thead class="bg-light" >
                <th> <i class="fas fa-question-circle"></i> Question </th>
                <th> <i class="far fa-check-circle"></i>  Count </th>
                <th> <i class="fas fa-percent"></i> Correct Percentage </th>
                <th> <i class="fas fa-percent"></i> Error Percentage </th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($analysis as $question)
                    <tr>
                        <td> {!! $question['question'] !!} </td>
                        <td> <strong > {{$question['correct']}} / {{$exam_assignments}} </strong> </td>
                        <td> 
                            <?php 
                                $percentage = $question['correct'] / $exam_assignments * 100
                            ?> 
                            <strong class="text-success"> {{round($percentage)}} % </strong> <br>
                       
                        </td>
                        <td>
                            <?php 
                                $percentage_error = $question['wrong'] / $exam_assignments * 100
                            ?> 
                            <strong class="text-danger"> {{round($percentage_error)}} % </strong> <br>
                            {{-- <progress class="text-danger" value="{{$percentage_error}}" max="100"> {{$percentage_error}}% </progress> --}}
                        </td>
                        <td>
                            <progress id="file" value="{{$percentage}}" max="100"> {{$percentage}}% </progress>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($student_answers_detailed as $key => $answers)
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            {!! App\Question::find($key)->instruction !!}
            <hr>
            <table class="table-sm table-hover ">
                <thead>
                    <th style="width:500px;"> Student </th>
                    <th style="width:50%"> Status </th>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        <tr>
                            <td>
                                <img  width="30" height="30" style="border-radius: 50%;" src="{{ url('/uploads/' . $answer['user']['avatar']) ?? url('/uploads/default-avatar.png')}}" /> 
                                {{$answer['user']['name']}} 
                            </td>
                            <td> 
                                @if ($answer['points'] == 1)
                              
                                    <i class="far fa-check-circle text-success"></i>
                                @endif

                                @if ($answer['points'] == 0)
                                    <i class="far fa-times-circle text-danger"></i>
                                @endif
                            </td>
                        </tr>
        
                    @endforeach
                </tbody>
            </table>
        
        </div>
    </div>
@endforeach






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        
</script>


@endsection
