@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">  <i class="fas fa-globe text-info"></i> Question Bank  </h4>
        <small class="text-muted"> <i> Manage questions </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Question Bank </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">

        <div class="dropdown">
            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-plus"></i> Create New Question
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{route('question-bank.create.mcq')}}"> Add Multiple Choice</a>
              <a class="dropdown-item" href="{{route('question-bank.create.tf')}}"> Add True or False</a>
              <a class="dropdown-item" href="{{route('question-bank.create.sa')}}"> Add Identification </a>
              {{-- <a class="dropdown-item" href="{{route('question-bank.create.essay')}}"> Add Essay </a> --}}
            </div>
        </div>


        {{-- <a href="{{route('question-bank.create')}}" class="btn btn-info btn-sm">  </a> --}}
        
        
        <ul class="nav nav-tabs mt-3" role="tablist">
            <li class="nav-item">
              <a class="nav-link {{Route::is('question-bank.index') ? 'active' : ''}}" href="{{route('question-bank.index')}}" >All Questions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::is('question-bank.my-questions') ? 'active' : ''}}" href="{{route('question-bank.my-questions')}}" >My Questions</a>
            </li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content border p-3">
            @yield('sub_content')
          </div>



    </div>
</div>

@endsection
