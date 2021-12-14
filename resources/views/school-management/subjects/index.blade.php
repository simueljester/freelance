@extends('school-management.index')

@section('sub-content')


   
<a href="{{route('school-management.subjects.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Subject </a>
<div class="mt-4">
    @forelse ($subjects as $subject)
    <div class="mt-3">
        <i class="fas fa-book-reader fa-2x"></i> &nbsp&nbsp <a href="{{route('school-management.subjects.show',$subject)}}" style="font-size:18px;text-decoration:none;" class="text-primary"> {{$subject->course_code}} <small class="text-muted"> {{$subject->name}}  </small> </a>
    </div>
         
    @empty
        <strong> No subjects created </strong>
    @endforelse
</div>


@endsection
