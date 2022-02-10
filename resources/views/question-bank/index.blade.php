@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">  <i class="fas fa-globe text-primary"></i> Question Bank  </h4>
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
      <div class="row">
        <div class="col-sm-6">
          <div class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-plus"></i> Create New Question
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{route('question-bank.create.mcq',0)}}"> Add Multiple Choice</a>
              <a class="dropdown-item" href="{{route('question-bank.create.tf',0)}}"> Add True or False</a>
              <a class="dropdown-item" href="{{route('question-bank.create.sa',0)}}"> Add Identification </a>
              <a class="dropdown-item" href="{{route('question-bank.create.essay',0)}}"> Add Essay </a>
            </div>
          </div>
          {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-upload"></i> Batch Question Upload
            </button> --}}
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
                <a href="{{route('question-bank.index')}}" class="btn btn-outline-secondary btn-sm "> Clear keyword </a>  
            @endif
          </form>
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


          <!-- Modal -->
          <form action="{{route('question-bank.batch-upload')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
           <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Batch Quesion Upload </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <a href="{{route('downloads.template','question_template.xlsx')}}"> Download Template </a>
                        <div class="form-group mt-3">
                            <span> File </span><br>
                            <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv"  required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm"> Upload </button>
                    </div>
                </div>
                </div>
            </div>
        </form>


    </div>
</div>

@endsection
