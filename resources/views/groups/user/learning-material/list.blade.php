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
            
                @if ($assignment->learning_material->file)
              
                    <i class="fas fa-download"></i> <a href="{{route('downloads.learning-material-attachment',[$assignment->learning_material->file,$assignment->group_id])}}" class="text-info"> {{$assignment->learning_material->file}}  </a>
                @endif
            </div>
            <div class="card-footer">
    
            </div>
        </div>
        @empty
            No learning materials available
    @endforelse
@endsection