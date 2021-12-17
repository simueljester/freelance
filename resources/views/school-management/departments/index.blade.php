@extends('school-management.index')

@section('sub-content')

<div class="row">
    <div class="col-sm-6">
        <a href="{{route('school-management.departments.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New Department </a>
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
                <a href="{{route('school-management.departments.index')}}" class="btn btn-outline-secondary btn-sm "> Clear keyword </a>  
            @endif
        </form>
    </div>
</div>


<div class="mt-4">
    @if ($departments->count())
        <div class="mb-3">Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }} departments </div>
    @endif
    
    <table class="table table-hover">
        <thead>
            <th> Name </th>
            <th> Academic Year </th>

        </thead>
        <tbody>
            @forelse ($departments as $department)
                <tr>
                    <td> <a href="{{route('school-management.departments.show',$department)}}"> {{$department->name}}  </a> </td>
                    <td> {{$department->activeAcademicYear->name}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2"> <strong> No department created </strong> </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $departments->links() }}
</div>



@endsection
