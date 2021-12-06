@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Class  </h4>
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
        <div class="col-sm-3">
            <div class="card shadow-sm mt-3 h-100">
                <div class="card-body">
                    <a href="{{route('groups.user-group.list-exam',$assignment->group)}}">
                        <strong class="text-info" style="font-size:18px;"> 
                            <i class="fas fa-cube"></i> {{$assignment->group->name}} 
                        </strong>
                    </a>
                    <br>
                    <small> <i class="fas fa-book-reader"></i> {{$assignment->group->subject->name}} </small>
                    &nbsp&nbsp
                    <small> <i class="fas fa-user"></i> {{$assignment->group->user_creator->name}}</small>
                 
                    <hr>
                    <small> {!! $assignment->group->description ?? 'No description' !!} </small>
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
