@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group Assignments </i>  </small>
    </div>
</div>


<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$discussion->group)}}"> {{$discussion->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('groups.discussion.show',$discussion)}}"> {{$discussion->name}} </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit </li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.discussion.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong class="text-muted"> Edit Discussion </strong>
            <hr>
            <div class="form-group mt-3">
                <span> Name </span>
                <input type="text" name="name" id="name" class="form-control" value="{{$discussion->name}}" required>
            </div>
            <div class="form-group mt-3">
                <span> Description (optional) </span>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control description"> {!! $discussion->description !!} </textarea>
            </div>
            <div class="form-group mt-3">
                @if ($discussion->attachment)
                    <i class="fas fa-paperclip"></i> <a href="{{route('downloads.question-attachment',$discussion->attachment)}}" class="text-primary"> {{$discussion->attachment}} </a> <br>
                @endif
                <input type="file" name="attachment" id="attachment" class="mt-3">
                <input type="hidden" name="old_attachment" id="old_attachment" value="{{$discussion->attachment}}">
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <input type="hidden" name="group" id="group" value="{{$discussion->group_id}}">
                <input type="text" class="form-control" value="{{$discussion->group->name}}" disabled>
            </div>
            <div class="form-group mt-3">
                <span> Total Score </span>
                <input type="number" name="total_score" min="1" id="duration" value="{{$discussion->total_score}}"  class="form-control" required>
            </div>
            <hr>
            <div>
                <input type="hidden" name="discussion_id" id="discussion_id" value="{{$discussion->id}}">
                <a href="{{route('groups.discussion.show',$discussion)}}" class="btn btn-outline-secondary btn-sm" > Cancel </a>
                <button class="btn btn-primary btn-sm"> Save Changes </button>
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
   
    $('.description').each( function () {
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
