@extends('school-management.index')

@section('sub-content')


<a href="{{route('school-management.departments.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Department </a>

<div class="mt-4">
    {{ $departments->links() }}
    <table class="table table-hover">
        <thead>
            <th> Name </th>
            <th> Academic Year </th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($departments as $department)
                <tr>
                    <td> <a href="{{route('school-management.departments.show',$department)}}"> {{$department->name}}  </a> </td>
                    <td> {{$department->activeAcademicYear->name}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> <strong> No department created </strong> </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>



@endsection
