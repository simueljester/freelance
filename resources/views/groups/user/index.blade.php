@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Class  </h4>
        <small class="text-muted"> <i> Class assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Class</li>
        </ol>
    </nav>
</div>
 

<div class="row">
    @forelse ($my_group_assignments as $assignment)
        <div class="col-sm-4 mt-1 p-3">
            <div class="card shadow-sm mt-3 h-100">
                <div class="card-body">
                    <a href="{{route('groups.user-group.list-exam',$assignment->group)}}">
                        <strong class="text-primary" style="font-size:18px;"> 
                            <i class="fas fa-cube"></i> {{$assignment->group->name}} 
                        </strong>
                    </a>
                    
                    <br>
                    <small> <i class="fas fa-book-reader"></i> Subject / Course Code:  <strong> {{$assignment->group->subject->course_code}} </strong>  </small>
                    <br>
                    <small> <i class="fas fa-user"></i> Instructor: <strong> {{$assignment->group->user_creator->name}} </strong>  </small>
                    <br>
                    <small> <i class="fas fa-flag"></i> Active AY: <strong> {{$assignment->group->activeAcademicYear->name}} </strong>  </small>
                    <br>
                    <small> <i class="fas fa-adjust"></i> Section: <strong> {{$assignment->group->section->name}} </strong>  </small>
                 
                    <hr>
                    <div id="class_description{{$assignment->group->id}}" class="class_description"> {!! $assignment->group->description !!}  </div> 
                    <strong class="text-primary" id="btn-see-more{{$assignment->group->id}}" class="btn-see-more" style="cursor:pointer" onclick="showFullDescription({{$assignment->group}})"> See more </strong>
                    <div id="full_class_description{{$assignment->group->id}}" class="full_class_description"></div>
                </div>
            </div>
        </div>
    @empty
    <div class="col-sm-3">
        <div class="card shadow-sm mt-2">
            <div class="card-body">
                No class created
            </div>
        </div>
    </div>
    
    @endforelse

</div>


@include('layouts.scripts')

<script>
    $(".class_description").text(function(index, currentText) {
        return currentText.substr(0, 250)+"...";
    });

  
    function showFullDescription(group){
        $('#full_class_description'+group.id).html(group.description)
        $( "#btn-see-more"+group.id).hide();
        $( "#btn-see-less"+group.id).show();
        $( "#class_description"+group.id).hide();
    }



</script>



@endsection
