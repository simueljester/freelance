@extends('groups.user.show')

@section('sub_content')
    @forelse ($my_learning_material_assignments as $assignment)
        <div class="card mt-3 shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong> <i class="fas fa-file-signature"></i> {{$assignment->learning_material->name}} </strong> 
               
            </div>
            <div class="card-body">
                {!! $assignment->learning_material->description ?? 'No description provided' !!}
                <hr>
            
                @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($assignment->learning_material->accessible_at)) && Carbon\Carbon::now()->lt(Carbon\Carbon::parse($assignment->learning_material->expired_at)))
                    @if ($assignment->learning_material->file)
                        <i class="fas fa-download"></i> <a href="{{route('downloads.learning-material-attachment',[$assignment->learning_material->file,$assignment->group_id])}}" class="text-primary"> {{$assignment->learning_material->file}}  </a>
                    @endif
                @else
                    You may access this learning materials between set dates
                @endif
       
            </div>
            <div class="card-footer">
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{Carbon\Carbon::parse($assignment->learning_material->accessible_at)->format('F d, Y h:i:s a')}}
                -
                &nbsp&nbsp
                <i class="far fa-calendar-check"></i> {{ $assignment->learning_material->expired_at ? Carbon\Carbon::parse($assignment->learning_material->expired_at)->format('F d, Y h:i a') : 'No expiration'}}
                &nbsp&nbsp
                <i class="fas fa-user"></i> {{$assignment->learning_material->userCreator->name}}
            </div>
        </div>
        @empty
            No learning materials available
    @endforelse
@endsection