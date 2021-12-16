@extends('school-management.index')

@section('sub-content')


<a href="{{route('school-management.sections.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Section </a>

<div class="mt-4">
    {{ $sections->links() }}
    <table class="table table-hover">
        <thead>
            <th> Name </th>
            <th> Academic Year </th>
            <th> Department </th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($sections as $section)
                <tr>
                    <td> <a href="{{route('school-management.sections.show',$section)}}"> <i class="fas fa-users"></i> {{$section->name}} </a> </td>
                    <td> {{$section->department->name}} </td>
                    <td> {{$section->activeAcademicYear->name}} </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> <strong> No sections created </strong> </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
