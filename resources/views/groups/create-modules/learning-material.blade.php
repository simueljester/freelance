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
            <li class="breadcrumb-item active" aria-current="page"> Create Learning Material </li>
        </ol>
    </nav>
</div>


<form action="{{route('groups.learning-material.save')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("POST")
   
    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <strong> Create Learning Material </strong>
            <hr>
            <div class="form-group mt-1">
                <span> Name </span> <span class="text-danger"> * </span>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <span> Description </span> <span class="text-danger"> * </span>
                <textarea name="description" id="description" c cols="30" rows="5" class="form-control description" required></textarea>
            </div>
            <div class="form-group mt-3">
                <span> Attachment </span> <span class="text-danger"> * </span> <br>
                <input type="file" name="attachment" id="attachment" required>
            </div>
            <div class="form-group mt-3">
                <span> Group </span>
                <input type="hidden" name="group" id="group" value="{{$group->id}}" class="form-control">
                <input type="text" value="{{$group->name}}" class="form-control" disabled>
            </div>
            <div class="form-group mt-3">
                <span> Accessible Date <span class="text-danger"> * </span> </span>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="accessible_date" id="accessible_date"  class="form-control" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="accessible_time" id="accessible_time"  class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <span> Expiration Date <span class="text-danger"> * </span></span>
                <br>
                <small class="text-muted"> Students may not be able to access this exam after set expiration date </small>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="date" name="expiration_date" id="expiration_date"  class="form-control" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="expiration_time" id="expiration_time"  class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <span> Course Requirements Visibility </span>
                <br>
                <input name="visibility" type="checkbox"  data-toggle="toggle" data-on="Visible" data-off="Hidden" data-onstyle="success" data-offstyle="secondary">
            </div>
            <hr>
            <div class="mt-3">
                <input type="hidden" name="folder_id" id="folder_id" value="{{$folder}}">
                <a href="{{route('groups.show',$group->id)}}" class="btn btn-outline-secondary"> Cancel </a>
                <button type="submit" class="btn btn-primary"> Create Learning Material </button>
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
