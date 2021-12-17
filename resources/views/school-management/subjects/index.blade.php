@extends('school-management.index')

@section('sub-content')


<div class="row">
    <div class="col-sm-6">
        <a href="{{route('school-management.subjects.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Subject </a>
    </div>
    <div class="col-sm-6">
        <form action="">
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Keyword.." aria-describedby="button-addon2" value="{{$keyword}}">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
            @if ($keyword)
                <a href="{{route('school-management.subjects.index')}}" class="btn btn-outline-secondary btn-sm "> Clear keyword </a>  
            @endif
        </form>
    </div>
</div>   

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
    {{ $subjects->links() }}

</div>


@endsection
