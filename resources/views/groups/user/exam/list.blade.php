@extends('groups.user.show')

@section('sub_content')
    @forelse ($my_exam_assignments as $assignment)
        <div class="card mt-3 shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong> <i class="fas fa-copy"></i> {{$assignment->exam->name}} </strong> 
                - 
                @if ($assignment->status == 1)
                    <span class="badge badge-success">Completed</span>
                @elseif ($assignment->status == 2)
                    <span class="badge badge-danger">Late Submission</span>
                @elseif ($assignment->status == 3)
                    <span class="badge badge-warning"> Attempted </span>
                @else
                    <span class="badge badge-secondary">Pending</span>
                @endif
            </div>
            <div class="card-body">
                {{$assignment->exam->description ?? 'No description provided'}}
                <hr>
                @if ($assignment->status == 1 || $assignment->status == 2)
                    <a href="{{route('groups.user-group.view-exam-result',$assignment)}}" class="btn btn-info btn-sm"> View Exam </a>   
                @else
                    @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($assignment->exam->accessible_at)))
                        <a href="{{route('groups.user-group.start-exam',$assignment)}}" class="btn btn-success btn-sm"> Start Exam </a>
                    @else
                        This exam will be available on scheduled date
                    @endif
                   
                @endif
            </div>
            <div class="card-footer">
                <i class="fas fa-clock"></i> {{$assignment->exam->duration}} minutes
                &nbsp&nbsp
                <i class="fas fa-star text-warning"></i> {{$assignment->score }} / {{$assignment->exam->total_score}} points
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{Carbon\Carbon::parse($assignment->exam->accessible_at)->format('F d, Y h:i:s a')}}
            </div>
        </div>
        @empty
            No exam available
    @endforelse
@endsection