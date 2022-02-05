@extends('groups.user.show')

@section('sub_content')
    @forelse ($my_link_assignments as $assignment)
        <div class="card mt-3 shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong> <i class="fas fa-link"></i> {{$assignment->link->name}} </strong> 
               
            </div>
            <div class="card-body">
                {!! $assignment->link->description ?? 'No description provided' !!}
                <hr>
                @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($assignment->link->accessible_at)) && Carbon\Carbon::now()->lt(Carbon\Carbon::parse($assignment->link->expired_at)))
                    <a href="{{$assignment->link->link}}" class="btn btn-primary btn-sm" target="_blank"> Open Link </a>
                @else
                You may access this link between set dates
                @endif
         
            </div>
            <div class="card-footer">
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{Carbon\Carbon::parse($assignment->link->accessible_at)->format('F d, Y h:i:s a')}}
                -
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{Carbon\Carbon::parse($assignment->link->expired_at)->format('F d, Y h:i:s a')}}
            </div>
        </div>
        @empty
            No links available
    @endforelse
@endsection