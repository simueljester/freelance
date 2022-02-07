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
                @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($assignment->discussion->accessible_at)) && Carbon\Carbon::now()->lt(Carbon\Carbon::parse($assignment->discussion->expired_at)))
                <a href="{{route('groups.user-group.start-discussion',$assignment->discussion)}}" class="btn btn-success btn-sm"> Open Discussion </a>
                @else
                    You may open this discussion between set dates
                @endif
                
            </div>
            <div class="card-footer">
                <i class="fas fa-star text-warning"></i> {{$assignment->score }} / {{$assignment->discussion->total_score}} points
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{Carbon\Carbon::parse($assignment->discussion->accessible_at)->format('F d, Y h:i:s a')}}
                -
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{ $assignment->discussion->expired_at ? Carbon\Carbon::parse($assignment->discussion->expired_at)->format('F d, Y h:i a') : 'No expiration'}}
            </div>
        </div>
        @empty
            No discussion available
    @endforelse
@endsection