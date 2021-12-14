@extends('school-management.index')

@section('sub-content')


   
<a href="{{route('school-management.subjects.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Subject </a>
<div class="mt-4">
    <table class="table table-hover">
        <thead>
            <th> Course Code </th>
            <th> Descriptive Title </th>
            <th> Academic Year </th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td> {{$subject->course_code}} </td>
                    <td> {{$subject->name}}  </td>
                    <td> {{$subject->activeAcademicYear->name}} </td>
                    <td> <a href="{{route('school-management.subjects.show',$subject)}}" class="btn btn-primary btn-sm">  View </a> </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> <strong> No subjects created </strong> </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>


@endsection
