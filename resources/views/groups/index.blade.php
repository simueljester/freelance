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

<div class="mt-3">
   
    @if (Auth::user()->user_instance->role_id == 1)
        <a href="{{route('groups.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Class </a>
        <a href="{{route('groups.list')}}" class="btn btn-primary btn-sm"> <i class="fas fa-cubes"></i>  All Class </a>
    @endif
</div>


<div class="row ">
    @forelse ($groups as $group)
        <div class="col-sm-4 mt-1 p-3">
            <div class="card shadow-sm mt-3 h-100">
                <div class="card-body">
                    <a href="{{route('groups.show',$group)}}"> <strong class="text-primary" style="font-size:18px;"> <i class="fas fa-cube"></i> {{$group->name}} </strong> </a> 
                    {{-- <a href="{{route('groups.group-assignment.index',$group)}}"> <strong class="text-info" style="font-size:18px;"> {{$group->name}} </strong> </a> --}}
                    @if (Auth::user()->user_instance->role_id == 1)
                        <a href="{{route('groups.edit',$group)}}" class="float-right"> <i class="fas fa-edit text-primary"></i> </a>
                    @endif
                    
                    <br>
                    <small> <i class="fas fa-book-reader"></i> Course Code:  <strong> {{$group->subject->course_code}} </strong>  </small>
                    <br>
                    <small> <i class="fas fa-user"></i> Assign Teacher: <strong> {{$group->user_creator->name}} </strong>  </small>
                    <br>
                    <small> <i class="fas fa-flag"></i> Active AY: <strong> {{$group->activeAcademicYear->name}} </strong>  </small>
                    <br>
                    <small> <i class="fas fa-adjust"></i> Program: <strong> {{$group->section->name}} </strong>  </small>
                    <hr>
                    <div id="class_description{{$group->id}}" class="class_description"> {!! $group->description !!}  </div>
                    <div id="full_class_description{{$group->id}}" class="full_class_description"></div> 
                    @if (strlen($group->description) >= 250)
                        <strong class="text-primary" id="btn-see-more{{$group->id}}" class="btn-see-more" style="cursor:pointer" onclick="showFullDescription({{$group}})"> See more </strong>
                        <strong class="text-primary" id="btn-see-less{{$group->id}}" class="btn-see-less" style="cursor:pointer;display:none" onclick="showLessDescription({{$group}})"> See Less </strong>
                    @endif
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
        if(currentText.length >= 250){
            return currentText.substr(0, 250)+"...";
        }
    });

    function showFullDescription(group){
        $( "#btn-see-more"+group.id).hide();
        $( "#btn-see-less"+group.id).show();
        $( "#class_description"+group.id).empty();
        $('#full_class_description'+group.id).html(group.description)
    }

    function showLessDescription(group){
        $( "#btn-see-more"+group.id).show();
        $( "#btn-see-less"+group.id).hide();
        $("#class_description"+group.id).html(group.description)
        $("#class_description"+group.id).text(function(index, currentText) {
            return currentText.substr(0, 250)+"...";
        });
        $('#full_class_description'+group.id).empty()
    }

</script>

@endsection
