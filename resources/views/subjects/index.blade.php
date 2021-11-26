@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-book-reader text-info"></i>  Subjects </h4>
        <small class="text-muted"> <i> Manage subjects </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Subjects </li>
        </ol>
    </nav>
</div>


<div class="card shadow-sm mt-2">
    <div class="card-body">
        <a href="{{route('subjects.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i> Create New Subject </a>
        <div class="mt-4">
            @forelse ($subjects as $subject)
                <div class="p-3 border rounded mt-3"> 
                    <i class="fas fa-book-reader fa-2x"></i> &nbsp&nbsp <a href="{{route('subjects.show',$subject)}}" style="font-size:22px;text-decoration:none;" class="text-info"> {{$subject->name}} </a> 
                </div>
            @empty
                <strong> No subjects created </strong>
            @endforelse
        </div>
    </div>
</div>

@endsection
