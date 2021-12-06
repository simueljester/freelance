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
    <a href="{{route('groups.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Class </a>
    @if (Auth::user()->user_instance->role_id == 1)
        <a href="{{route('groups.list')}}" class="btn btn-primary btn-sm"> <i class="fas fa-cubes"></i>  All Class </a>
    @endif
</div>
 
<div class="mt-3">

</div>

<div class="row">
    @forelse ($groups as $group)
        <div class="col-sm-3">
            <div class="card shadow-sm mt-3 h-100">
                <div class="card-body">
                    <a href="{{route('groups.show',$group)}}"> <strong class="text-primary" style="font-size:18px;"> <i class="fas fa-cube"></i> {{$group->name}} </strong> </a> 
                    {{-- <a href="{{route('groups.group-assignment.index',$group)}}"> <strong class="text-info" style="font-size:18px;"> {{$group->name}} </strong> </a> --}}
                    <a href="{{route('groups.edit',$group)}}" class="float-right"> <i class="fas fa-edit text-primary"></i> </a>
                    <br>
                    <small> <i class="fas fa-book-reader"></i> {{$group->subject->course_code}} {{$group->subject->name}} </small>
                    <br>
             
                    <small> <i class="fas fa-user"></i> {{$group->user_creator->name}} </small>
                    <hr>
                    <small> {!! $group->description !!} </small>
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

@endsection
