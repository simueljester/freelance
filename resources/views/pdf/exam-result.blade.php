<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Exam PDF </title>
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
    <div class="card shadow-sm mt-3 m-5">
        <div class="card-body">
            <h4> <strong> {{$exam_assignment->exam->name}} </strong> </h4>
            <span> {{$exam_assignment->exam->description}} </span>
            <hr>
            Name: {{$exam_assignment->user->name}} <br>
            Email: {{$exam_assignment->user->email}} <br>
            Group: {{$exam_assignment->group->name}}
            Score: {{$exam_assignment->score}} / {{$exam_assignment->exam->total_score}}
            <br>

            @if ($exam_assignment->status == 1)
                <span class="badge badge-success"> Completed </span>
            @endif
            @if ($exam_assignment->status == 2)
                <span class="badge badge-danger"> Late Submission </span>
            @endif

            @foreach ($exam_assignment->user_answers as $user_answer)
                <div class="border rounded p-3 mt-5">
                    <strong> Question {{ $loop->index + 1}} </strong> - {{$user_answer->question->question_type}}
                    <br>
                    {!!$user_answer->question->instruction!!}
                    <br>
                    @switch($user_answer->question->question_type)
                        @case('mcq')
                        <ol type="a">
                            {{-- option 1 --}}
                            <li>
                                <label class="form-check-label" for="exampleRadios2"> {{$user_answer->question->option_1}} </label>
                            </li>
                            
                            {{-- option 2 --}}
                            <li>
                                <label class="form-check-label" for="exampleRadios2"> {{$user_answer->question->option_2}} </label>
                            </li>
                        
                            {{-- option 3 --}}
                            <li>
                                @if ($user_answer->question->option_3)
                                    <label class="form-check-label" for="exampleRadios2"> {{$user_answer->question->option_3}} </label>
                                @endif
                            </li>
                    
                            {{-- option 4 --}}
                            <li>
                                @if ($user_answer->question->option_4)
                                    <label class="form-check-label" for="exampleRadios2"> {{$user_answer->question->option_4}} </label>
                                @endif
                            </li>
            
                            {{-- option 5 --}}
                            <li>
                                @if ($user_answer->question->option_5)
                                    <label class="form-check-label" for="exampleRadios2"> {{$user_answer->question->option_5}} </label>
                                @endif
                            </li>
                    
                        </ol>

                        @break
                        @case('tf')
                        <ol type="a">
                            <li> True </li>
                            <li> False </li>
                        </ol>
                        @break
                    @endswitch
                    <br>

                    <small class="text-muted">User Answer</small>
                    <br>
                    {!! $user_answer->user_answer !!}
                    <hr>
                    Correct Answer : <strong class="text-info"> {{$user_answer->question->answer ?? 'Not available'}}  </strong>
                    <br>
                    Points: <strong> {{$user_answer->points}} </strong>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>