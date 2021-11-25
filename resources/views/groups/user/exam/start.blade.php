<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Start Exam </title>
    @include('layouts.styles') 
</head>
<style>
    .sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 9999;
        color:#fff;
    }
</style>
<body class="bg-light">
    
    {{-- Hide Camera HTML Elements  --}}
    <div hidden>

        <button class="btn btn-success btn-block"   id="btn_take_snap"> Take shot </button>
        <button id="btn_save_image" > Save </button>
        <div id="camera" ></div>
        <div  id="snapShot" ></div>
    </div>

    <form action="{{route('groups.user-group.save-exam')}}" method="POST">
    @csrf
    @method('POST')

    <div class="bg-info text-white sticky p-3">
       
        <i class="fas fa-hourglass-half fa-lg fa-spin"></i>
        &nbsp&nbsp
        <span id="time"></span> minutes remaining
        &nbsp&nbsp
        <span class="badge badge-danger p-1" id="duration_status_display"> Late Submission </span>
    </div>

        <div class="container">
            <div class="card shadow-sm mt-3 m-5">
                <div class="card-body">
                    <h4> <strong> {{$exam_assignment->exam->name}} </strong> </h4>
                    <span> {{$exam_assignment->exam->description}} </span>

                    @foreach ($exam_assignment->exam->questionAssignments as $question_assignments)
                        <div class="card mt-3">
                            <div class="card-header">
                                <i> <i class="far fa-question-circle"></i> Question {{ $loop->index + 1}} </i> <small class="text-uppercase float-right"> {{$question_assignments->question->question_type}} </small> 
                            </div>
                            <div class="card-body">
                                {!!$question_assignments->question->instruction!!}
                                <hr>
                                @switch($question_assignments->question->question_type)
                                    @case('mcq')
                                        {{-- option 1 --}}
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="a" style="cursor:pointer;" required>
                                            <label class="form-check-label" for="exampleRadios2">
                                                {{$question_assignments->question->option_1}}
                                            </label>
                                        </div>
                                        {{-- option 2 --}}
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="b" style="cursor:pointer;" required>
                                            <label class="form-check-label" for="exampleRadios2">
                                                {{$question_assignments->question->option_2}}
                                            </label>
                                        </div>

                                        {{-- option 3 --}}
                                        @if ($question_assignments->question->option_3)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="c" style="cursor:pointer;" required>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    {{$question_assignments->question->option_3}}
                                                </label>
                                            </div>  
                                        @endif

                                        {{-- option 4 --}}
                                        @if ($question_assignments->question->option_4)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="d" style="cursor:pointer;" required>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    {{$question_assignments->question->option_4}}
                                                </label>
                                            </div>  
                                        @endif

                                        {{-- option 5 --}}
                                        @if ($question_assignments->question->option_5)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="e" style="cursor:pointer;" required>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    {{$question_assignments->question->option_5}}
                                                </label>
                                            </div>  
                                        @endif

                                        {{-- option 6 --}}
                                        @if ($question_assignments->question->option_6)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="f" style="cursor:pointer;" required>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    {{$question_assignments->question->option_6}}
                                                </label>
                                            </div>  
                                        @endif

                                        @break
                                    @case('tf')
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="true" style="cursor:pointer;" required>
                                            <label class="form-check-label" for="exampleRadios2">
                                                True
                                            </label>
                                        </div> 
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="answer[{{$question_assignments->question->id}}]"  value="false" style="cursor:pointer;" required>
                                            <label class="form-check-label" for="exampleRadios2">
                                                False
                                            </label>
                                        </div> 
                                        @break
                                    @case('sa')
                                        <div class="form-group">
                                            <span> Your answer </span>
                                            <input type="text" name="answer[{{$question_assignments->question->id}}]" class="form-control" required>
                                        </div>
                                        @break
                                    @case('essay')
                                        <textarea required name="answer[{{$question_assignments->question->id}}]" id="essay{{$question_assignments->question->id}}" cols="30" rows="10" class="essay"></textarea>
                                        @break

                                @endswitch
                            </div>
                       
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <input type="hidden" name="exam_id" id="exam_id" value="{{$exam_assignment->exam_id}}">
                    <input type="hidden" name="exam_assignment_id" id="exam_assignment_id" value="{{$exam_assignment->id}}">
                    <input type="hidden" name="group_id" id="group_id" value="{{$exam_assignment->group_id}}">
                    <input type="hidden" name="duration_status" id="duration_status" value="1">
                    <button class="btn btn-success btn-block"> Finish Exam </button>
                </div>
            </div>
        </div>
    </form>

    @include('layouts.scripts') 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script> 
    <script>
  
        $('.essay').each( function () {
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


        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
               
                    timer = 0;
               
                    $("#duration_status_display").show();
                    $("#duration_status").val(2);
                    return; 
                }
            }, 1000);
        }

        window.onload = function () {
            var duration = {{ $exam_assignment->exam->duration }}
            $("#duration_status_display").hide();
            var fiveMinutes = 60 * duration,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);

        };


    takeWebCamera()

    var exam_id = {{$exam_assignment->exam->id}} 
    var exam_assignment_id = {{$exam_assignment->id}} 
    var group_id = {{$exam_assignment->group_id}} 

    function takeWebCamera(){

        navigator.getMedia = ( navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
        navigator.getMedia({video: true}, function() {
            Webcam.set({
                width: 340,
                height: 280,
                image_format: 'jpeg',
                jpeg_quality: 100
            });

            Webcam.attach('#camera');
            console.log("camera detected")
        
        }, function() {
            console.log("no camera detected")
        });

 
        setInterval(function() {$('#btn_take_snap').trigger('click');}, 5000);
        setInterval(function() {$('#btn_save_image').trigger('click');}, 6000);

        $('#btn_take_snap').on('click', function () {
            Webcam.snap(function (data_uri) {
                document.getElementById('snapShot').innerHTML = 
                    '<img src="' + data_uri + '" width="550" height="350" id="image_shot" />';
                });
        });

        $('#btn_save_image').on('click', function () {
            var img = document.getElementById('image_shot').src
            var _formdata = new FormData();
                _formdata.append('image', img);
                _formdata.append('exam_id', exam_id);
                _formdata.append('exam_assignment_id', exam_assignment_id);
                _formdata.append('group_id', group_id);
         
                _formdata.append('_token', "{{ csrf_token() }}");
            $.ajax({
                    url: "{{ route('groups.user-group.save-webshot') }}",
                    method: "POST",
                    data: _formdata,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data){
                        console.log("shot captured")
                        console.log(data);
                    },
                    complete: function(){
                    }
            })
        });
    
    }
</script>

</body>
</html>