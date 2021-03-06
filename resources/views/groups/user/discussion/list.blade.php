@extends('groups.user.show')

@section('sub_content')
    @forelse ($my_discussion_assignments as $assignment)
        <div class="card mt-3 shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong> <i class="fas fa-comment-dots"></i> {{$assignment->discussion->name}} </strong> 
               
            </div>
            <div class="card-body">
                {!! $assignment->discussion->description ?? 'No description provided' !!}
                <hr>
                <a href="{{route('groups.user-group.start-discussion',$assignment->discussion)}}" class="btn btn-success btn-sm"> Open Discussion </a>
            </div>
            <div class="card-footer">
                <i class="fas fa-star text-warning"></i> {{$assignment->score }} / {{$assignment->discussion->total_score}} points
            </div>
        </div>
        @empty
            No discussion available
    @endforelse
@endsection