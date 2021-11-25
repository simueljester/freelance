@extends('layouts.app')

@section('content')


<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Group</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Create Exam </li>
        </ol>
    </nav>
</div>

<form action="#" method="POST">
    @csrf
    @method("POST")
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <strong class="text-muted"> Create Discussion </strong>
            <hr>
        
        </div>
    </div>
</form>

@endsection
