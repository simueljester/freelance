@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-book-reader text-primary"></i>  School Management </h4>
        <small class="text-muted"> <i> Manage subjects, teacher departments and student sections </i>  </small>
    </div>
</div>

{{-- <div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> School Management  </li>
        </ol>
    </nav>
</div> --}}


<ul class="nav nav-tabs mt-3">
    <li class="nav-item">
        <a class="nav-link {{Route::is('school-management.academic-year.index') ? 'active' : ''}}"  href="{{route('school-management.academic-year.index')}}"> Academic Year </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Route::is('school-management.subjects.index') ? 'active' : ''}}"  href="{{route('school-management.subjects.index')}}"> Subjects </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"  href="#"> Departments </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"  href="#"> Sections </a>
    </li>
</ul>
<div class="card shadow-sm">
    <div class="card-body">
        @yield('sub-content')
    </div>
</div>

@endsection
