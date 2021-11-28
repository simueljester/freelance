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
                <a href="{{$assignment->link->link}}" class="btn btn-info btn-sm" target="_blank"> Open Link </a>
            </div>
            <div class="card-footer">
    
            </div>
        </div>
        @empty
            No links available
    @endforelse
@endsection