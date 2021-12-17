@extends('school-management.index')

@section('sub-content')

<div class="row">
    <div class="col-sm-6">
        <a href="{{route('school-management.sections.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Section </a>
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
                <a href="{{route('school-management.sections.index')}}" class="btn btn-outline-secondary btn-sm "> Clear keyword </a>  
            @endif
        </form>
    </div>
</div>


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
