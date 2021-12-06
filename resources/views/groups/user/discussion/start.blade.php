<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Start Discussion </title>
    @include('layouts.styles') 
</head>
<style>
    .sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 9999;
   
    }
</style>
<body class="bg-light">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i> {{ session()->get('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation"></i> <strong> There are error(s) in your request  </strong> 
            <br>  <br>  
            @foreach ($errors->all() as $error)
                <div> <i class="fas fa-caret-right"></i> {{$error}}  </div>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4 ">
            <div class="sticky">

                <div class="card shadow-sm  m-3">
                    <div class="card-body">
                  
                        <h4> <strong> <i class="fas fa-comment-dots"></i> {{$discussion->name}} </strong>  
                            <hr>
                            @if ($discussion->creator == Auth::user()->id)
                                <a href="{{route('groups.discussion.show',$discussion)}}" class="btn btn-outline-secondary btn-sm"> Back to groups </a> 
                            @else
                                <a href="{{route('groups.user-group.list-discussion',$discussion->group)}}" class="btn btn-outline-secondary btn-sm"> Back to groups </a> 
                            @endif
             
                        </h4> 
                        <br>
                        <span class="mt-3"> {!! $discussion->description !!} </span>
                        <hr>
                        @if ($discussion->attachment)
                            <i class="fas fa-paperclip"></i> <a href="{{route('downloads.question-attachment',$discussion->attachment)}}" class="text-info"> {{$discussion->attachment}} </a>
                        @endif
          
                        @if ($discussion->creator == Auth::user()->id)
                            &nbsp&nbsp
                            <a class="text-success" data-toggle="collapse" href="#collapseUserAssignment" role="button" > <i class="fas fa-users-cog"></i> Score Users </a>
                        @endif
                    </div>
                </div>
                <form action="{{route('groups.discussion.save-scores')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="collapse mt-3 " id="collapseUserAssignment">
                        <div class="p-3 bg-white border shadow-sm mr-3 ml-3">
                            <strong> Score Users </strong>
                            <br>
                           <table class="table table-hover mt-3">
                               <thead>
                                   <th style="width: 40%;"> User </th>
                                   <th style="width: 30%;"> Score </th>
                                   <th style="width: 30%;"></th>
                               </thead>
                               <tbody>
                                   @forelse ($discussion_assignments as $assignment)
                                   <tr>
                                       <td> {{$assignment->user->name}} </td>
                                       <td> {{$assignment->score}} / {{$assignment->discussion->total_score}} </td>
                                       <td> <input class="form-control" type="number" name="score[{{$assignment->id}}]" id="score" min="0" max="{{$assignment->discussion->total_score}}" value="{{$assignment->score}}"> </td>
                                   </tr>
                                  
                                   @empty
                                       <tr>
                                           <td colspan="3"> No users assigned </td>
                                       </tr>
                                   @endforelse
                               </tbody>
                           </table>
                           <hr>
                           <button class="btn btn-info btn-sm"> Save Scores <i class="far fa-check-circle"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
    
        </div>
        <div class="col-sm-7">
            <form action="{{route('groups.user-group.save-discussion-post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <div class="form-group">
                            <strong> Post </strong>
                            <textarea name="post" id="post" cols="30" rows="5" class="post"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="attachment" id="attachment" >
                        </div>
                        <div>
                            <input type="hidden" name="discussion_id" id="discussion_id" value="{{$discussion->id}}">
                            <button class="btn btn-info btn-sm"> Post <i class="fas fa-paper-plane"></i> </button>
                        </div>
                    </div>
                </div>
            </form>
  
            <div class="card shadow-sm mt-3">
         
                <div class="card-body">
                    <strong> <i class="fas fa-users"></i> User's Participation </strong>
                    @forelse ($posts as $post)
                        <div class="card mt-4  shadow-sm">
                            <div class="card-header">
                                <i class="fas fa-user-circle"></i>  {{$post->user->name}} - <small> <i> {{$post->user->user_instance->role->role}} </i>  </small>
                                <span class="float-right"> <i class="fas fa-calendar-alt"></i> <small> {{$post->created_at->format('Y-m-d h:m:s a')}} </small> </span>
                            </div>
                            <div class="card-body">
                                {!! $post->description !!}
                            </div>
                            <div class="card-footer">
                                @if ($post->attachment)
                                    <a href="{{route('downloads.discussion-attachment',$post->attachment)}}" class="text-info"> <i class="fas fa-download"></i> {{$post->attachment}} </a>
                                @endif
                            </div>
                        </div>
                    @empty
                    <div class="mt-3">
                       <i> No participation found </i> 
                    </div>
                    
                    @endforelse
                
                </div>
            </div>
        </div>
    </div>


   

    <div class="container">
      
    </div>


    {{-- @include('layouts.scripts')  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
   
        $('.post').each( function () {
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

</body>
</html>