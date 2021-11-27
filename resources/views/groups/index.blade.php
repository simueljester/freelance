@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Groups</li>
        </ol>
    </nav>
</div>

<div class="mt-3">
    <a href="{{route('groups.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i> Create New Group </a>
</div>
 

<div class="row">
    @forelse ($groups as $group)
        <div class="col-sm-3">
            <div class="card shadow-sm mt-3 h-100">
                <div class="card-body">
                    <a href="{{route('groups.show',$group)}}"> <strong class="text-info" style="font-size:18px;"> <i class="fas fa-cube"></i> {{$group->name}} </strong> </a> 
                    {{-- <a href="{{route('groups.group-assignment.index',$group)}}"> <strong class="text-info" style="font-size:18px;"> {{$group->name}} </strong> </a> --}}
                    <a href="{{route('groups.edit',$group)}}" class="float-right"> <i class="fas fa-edit text-info"></i> </a>
                    <br>
                    <small> <i class="fas fa-book-reader"></i> {{$group->subject->name}} </small>
                    &nbsp&nbsp
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
                No groups created
            </div>
        </div>
    </div>
    
    @endforelse

</div>

@endsection
