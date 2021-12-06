@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-paste text-white text-primary"></i>  Examination  </h4>
        <small class="text-muted"> <i> Manages examination details, assignment, questions and settings </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Examination</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h5 class="text-muted"> My Created Examinations </h5>
        <small> To create an examination, Go to Groups > Assign User > Create Exam </small>

        {{-- <a href="{{route('examination.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i> Create New Exam </a> --}}
    
        <table class="table table-hover mt-3">
            <thead>
                <th> Name </th>
                <th> Group </th>
                <th> Creation Date </th>
          
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr>
                        <td> <a href="{{route('examination.show',$exam)}}" class="text-primary"> {{$exam->name}}</a>  </td>
                        <td> {{$exam->group->name}} </td>
                        <td> {{$exam->created_at->format('Y-m-d')}} </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"> No Exam Created </td>
                    </tr>
                @endforelse
        
            </tbody>

        </table>

    </div>
</div>

@endsection
