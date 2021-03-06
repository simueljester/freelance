@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group Assignments </i>  </small>
    </div>
</div>


<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$learning_material->group)}}"> {{$learning_material->group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('groups.learning-material.show',$learning_material)}}"> {{$learning_material->name}} </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Edit </li>
        </ol>
    </nav>
</div>

<form action="{{route('groups.learning-material.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong class="text-muted"> Edit Learning Material </strong>
            <hr>
            <div class="form-group mt-3">
                <span> Name </span>
                <input type="text" name="name" id="name" class="form-control" value="{{$learning_material->name}}" required>
            </div>
            <div class="form-group mt-3">
                <span> Description (optional) </span>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control description"> {!! $learning_material->description !!} </textarea>
            </div>
            <div class="form-group mt-3">
                @if ($learning_material->file)
                    <i class="fas fa-paperclip"></i> <a href="{{route('downloads.question-attachment',$learning_material->file)}}" class="text-info"> {{$learning_material->file}} </a> <br>
                @endif
                <input type="file" name="attachment" id="attachment" class="mt-3">
                <input type="hidden" name="old_attachment" id="old_attachment" value="{{$learning_material->file}}">
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <input type="hidden" name="group" id="group" value="{{$learning_material->group_id}}">
                <input type="text" class="form-control" value="{{$learning_material->group->name}}" disabled>
            </div>

            <hr>
            <div>
                <input type="hidden" name="learning_material_id" id="learning_material_id" value="{{$learning_material->id}}">
                <a href="{{route('groups.learning-material.show',$learning_material)}}" class="btn btn-outline-secondary btn-sm" > Cancel </a>
                <button class="btn btn-info btn-sm"> Save Changes </button>
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
