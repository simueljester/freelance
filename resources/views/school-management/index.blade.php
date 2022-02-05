@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-university"></i>  School Management </h4>
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
    <li class="nav-item ">
        @if (Route::is('school-management.subjects.index'))
            <a class="nav-link active"  href="{{route('school-management.subjects.index')}}"> Subjects </a>
       
        @elseif (Route::is('school-management.subjects.create'))
            <a class="nav-link active"  href="{{route('school-management.subjects.index')}}"> Subjects </a>
   
        @elseif (Route::is('school-management.subjects.show'))
            <a class="nav-link active"  href="{{route('school-management.subjects.index')}}"> Subjects </a>
        @else
            <a class="nav-link "  href="{{route('school-management.subjects.index')}}"> Subjects </a>
        @endif 
    </li>
    <li class="nav-item">
        @if (Route::is('school-management.departments.index'))
            <a class="nav-link active"  href="{{route('school-management.departments.index')}}"> Departments </a>
        @elseif (Route::is('school-management.departments.create'))
            <a class="nav-link active"  href="{{route('school-management.departments.index')}}"> Departments </a>
        @elseif (Route::is('school-management.departments.show'))
            <a class="nav-link active"  href="{{route('school-management.departments.index')}}"> Departments </a>
        @else
            <a class="nav-link "  href="{{route('school-management.departments.index')}}"> Departments </a>
        @endif 
    </li>
    <li class="nav-item">
        @if (Route::is('school-management.sections.index'))
            <a class="nav-link active"  href="{{route('school-management.sections.index')}}"> Programs </a>
        @elseif (Route::is('school-management.sections.create'))
            <a class="nav-link active"  href="{{route('school-management.sections.index')}}"> Programs </a>
        @elseif (Route::is('school-management.sections.show'))
            <a class="nav-link active"  href="{{route('school-management.sections.index')}}"> Programs </a>
        @else
            <a class="nav-link "  href="{{route('school-management.sections.index')}}"> Programs </a>
        @endif 
    </li>

  
    {{--
    <li class="nav-item">
        <a class="nav-link"  href="#"> Sections </a>
    </li> --}}
</ul>
<div class="card shadow-sm mt-2">
    <div class="card-body">
        @yield('sub-content')
    </div>
</div>

@endsection
