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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group->id)}}"> {{$group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Create Discussion </li>
        </ol>
    </nav>
</div>

{{-- Modal create discussion  --}}
<form action="{{route('groups.discussion.save')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("POST")
   
    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <strong> Create Discussion </strong>
            <hr>
            <div class="form-group mt-1">
                <span> Name </span>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <span> Description (optional) </span>
                <textarea name="description" id="description" c cols="30" rows="5" class="form-control description"></textarea>
            </div>
            <div class="form-group mt-3">
                <input type="file" name="attachment" id="attachment">
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <input type="hidden" name="group" id="group" value="{{$group->id}}" class="form-control">
                <input type="text" value="{{$group->name}}" class="form-control" disabled>
            </div>
            <div class="form-group mt-3">
                <span> Total score </span>
                <input type="number" name="total_score" min="1" id="total_score" value="1"  class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <span> Module Visibility </span>
                <br>
                <input name="visibility" type="checkbox" checked data-toggle="toggle" data-on="Visible" data-off="Hidden" data-onstyle="success" data-offstyle="secondary">
            </div>
            <hr>
            <div class="mt-3">
                <input type="hidden" name="folder_id" id="folder_id" value="{{$folder}}">
                <a href="{{route('groups.show',$group->id)}}" class="btn btn-outline-secondary"> Cancel </a>
                <button type="submit" class="btn btn-primary"> Create discussion </button>
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
