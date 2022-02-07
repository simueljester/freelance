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
                    <i class="fas fa-paperclip"></i> <a href="{{route('downloads.question-attachment',$learning_material->file)}}" class="text-primary"> {{$learning_material->file}} </a> <br>
                @endif
                <input type="file" name="attachment" id="attachment" class="mt-3">
                <input type="hidden" name="old_attachment" id="old_attachment" value="{{$learning_material->file}}">
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <input type="hidden" name="group" id="group" value="{{$learning_material->group_id}}">
                <input type="text" class="form-control" value="{{$learning_material->group->name}}" disabled>
            </div>
            <div class="form-group mt-3">
                <span> Accessible Date </span>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="accessible_date" id="accessible_date"  class="form-control" value="{{Carbon\Carbon::parse($learning_material->accessible_at)->format('Y-m-d')}}" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="accessible_time" id="accessible_time"  class="form-control" value="{{Carbon\Carbon::parse($learning_material->accessible_at)->format('H:i')}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <span> Expiration Date (optional) </span>
                <br>
                <small class="text-muted"> Students may not be able to access this exam after set expiration date </small>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="expiration_date" id="expiration_date"  class="form-control" value="{{ $learning_material->expired_at ? Carbon\Carbon::parse($learning_material->expired_at)->format('Y-m-d') : null}}" >
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="expiration_time" id="expiration_time"  class="form-control" value="{{ $learning_material->expired_at ? Carbon\Carbon::parse($learning_material->expired_at)->format('H:i') : null }}" >
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <span> Course Requirements Visibility </span>
                <br>
                <input name="visibility" type="checkbox" {{$learning_material->groupModule->visibility == 1 ? 'checked' : null}} data-toggle="toggle" data-on="Visible" data-off="Hidden" data-onstyle="success" data-off-style="secondary">
            </div>
            <hr>
            <div>
                <input type="hidden" name="learning_material_id" id="learning_material_id" value="{{$learning_material->id}}">
                <a href="{{route('groups.learning-material.show',$learning_material)}}" class="btn btn-outline-secondary btn-sm" > Cancel </a>
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
