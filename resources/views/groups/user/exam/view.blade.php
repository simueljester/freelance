<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Start Exam </title>
    @include('layouts.styles') 
</head>

<body class="bg-light">
        <div class="container">
            <div class="card shadow-sm mt-3 m-5">
                <div class="card-body">
                    <h4> <strong> {{$exam_assignment->exam->name}} </strong> </h4>
                    <span> {{$exam_assignment->exam->description}} </span>
                    <hr>
                    <i class="fas fa-user"></i> {{$exam_assignment->user->name}}
                    &nbsp&nbsp
                    <i class="fas fa-cube"></i> {{$exam_assignment->group->name}}
                    &nbsp&nbsp
                    <i class="fas fa-star text-warning"></i> {{$exam_assignment->score}} / {{$exam_assignment->exam->total_score}}
                    &nbsp&nbsp
                    @if ($exam_assignment->status == 1)
                        <span class="badge badge-success"> Completed </span>
                    @endif
                    @if ($exam_assignment->status == 2)
                        <span class="badge badge-danger"> Late Submission </span>
                    @endif
                    @if ($exam_assignment->status == 4)
                        <span class="badge badge-warning"> Incomplete </span> <small> Some questions requires manual checking </small>
                    @endif
                    &nbsp&nbsp
                    Attempt No. {{$exam_assignment->attempt}} 
                    {{-- <span class="text-primary" style="cursor:pointer" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-camera"></i> Captured Shots  </span> --}}
                 
                   
                    <div class="mt-5">
                        @foreach ($exam_assignment->user_answers as $user_answer)
                        <div class="card mt-3">
                            <div class="card-header">
                                <i> <i class="far fa-question-circle"></i> Question {{ $loop->index + 1}} </i> <small class="text-uppercase float-right"> {{$user_answer->question->question_type}} </small> 
                                @if ($user_answer->question->question_type == 'essay' && Auth::user()->user_instance->role->id !=3)
                        
                                   <small> - Click <strong class="text-primary" style="cursor:pointer;" onclick="showOverrideInput({{$user_answer}},{{$loop->index+1}})"> here </strong> to override essay score </small> 
                                @endif
                            </div>
                            <div class="card-body">
                                {!!$user_answer->question->instruction!!}
                                <hr>
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
                         
                                <small class="text-uppercase"> User Answer  
                                    @if ($user_answer->user_answer == $user_answer->question->answer || $user_answer->points == 1)
                                        - <i class="fas fa-check-circle text-success"></i>  
                                    @elseif($user_answer->question->question_type == 'essay')
                                        - <strong> To override </strong> 
                                    @else
                                        - <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </small> 

                                <div class="p-3 border rounded">
                                {!! $user_answer->user_answer !!}
                                </div>

                            </div>
                            <div class="card-footer">
                                Correct Answer : <strong class="text-primary"> {{$user_answer->question->answer ?? 'Not available'}}  </strong>
                                &nbsp&nbsp 
                                Points: <strong> {{$user_answer->points}} </strong>
                            </div>
                        </div>
                        @endforeach
                    </div>
                   
                </div>
                <div class="card-footer">
                    {{-- <a href="{{route('groups.user-group.show',$exam_assignment->group_id)}}" class="btn btn-outline-seconday btn-block"> <i class="fas fa-arrow-alt-circle-left"></i> Back to Group </a> --}}
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-outline-seconday btn-block"> <i class="fas fa-arrow-alt-circle-left"></i> Back to Group </a> --}}
               
                    @if (Auth::user()->user_instance->role_id == 2)
                        <a href="{{route('groups.exam.mark-complete',$exam_assignment)}}" class="btn btn-success btn-fill"  onclick="return confirm('Are you sure you want to mark this exam as complete? ')"> Mark as complete </a>
                    @endif
                    
                </div>
            </div>
        </div>
  
 

<!-- Modal Show Web Shots -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Captured Shots </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <ul>
                                @forelse ($exam_assignment->webShots as $shot)
                                    <li onclick="previewImage({{$shot}})" style="cursor: pointer;" class="text-primary"> <i class="fas fa-camera"></i> {{$shot->filename}} - <small> {{$shot->created_at->format('Y/m/d H:m:s')}} </small> </li>
                         
                                @empty
                                    <li> No shots captured </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    @if (count($exam_assignment->webShots) != 0)
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <img id="preview-image" alt="" title="" style="width: 100%" />
                                <div class="mt-2">
                                    <div id="image-name"></div>
                                    <div id="image-created"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
          
        </div>
        <div class="modal-footer">
 
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Override Score-->
  <form action="{{route('groups.exam.override')}}" method="POST">
      @csrf
      @method("POST")
      <div class="modal fade" id="override-score" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Override Score</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <span> Override score in question no. <span id="question_index"></span> </span>
              <div class="form-group mt-3">
                  <span> Input Score </span>
                  <input type="number" name="score" id="score" class="form-control">
                  <small id="max-score"></small>
                  <input type="hidden" name="answer_id" id="answer_id">
                  <input type="hidden" name="exam_assignment_id" id="exam_assignment_id">
                  <input type="hidden" name="status" id="status" value="{{$exam_assignment->status}}">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
            </div>
          </div>
        </div>
      </div>
  </form>



    @include('layouts.scripts') 

    <script>
        function previewImage(image_object){
     
            $('#image-name').html(image_object.filename)
            $('#image-created').html(image_object.created_at)
            $('#preview-image').attr('src', "/uploads/"+image_object.filename);
        }

        function showOverrideInput(user_answer,question_no){
        
            $('#answer_id').val(user_answer.id)
            $("#score").val(user_answer.points)
            $("#exam_assignment_id").val(user_answer.exam_assignment_id)
     
            
            $("#score").attr("max",user_answer.question.max_points)
            $('#max-score').html('Max score:' + user_answer.question.max_points)
            $('#question_index').html(question_no)
            $("#override-score").modal('show');
            
        }
    </script>

</body>
</html>