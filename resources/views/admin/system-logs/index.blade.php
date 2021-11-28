@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-user-cog text-info"></i>  Administrator </h4>
        <small class="text-muted"> <i> Access / Manage reports, logins and user accounts as system adminstrator </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('administrator.index')}}">Administrator</a></li>
            <li class="breadcrumb-item"> System Logs </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header">
        <strong> System Logs </strong>
    </div>
    <div class="card-body">
        <form action="">
            <div class="row" class="mb-5">
                <div class="col-sm-4">
                    <div class="form-group">
                        <small class="text-muted"> Start Date </small>
                        <input type="date" class="form-control" name="start_date" value="{{$start_date}}" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <small class="text-muted"> End Date </small>
                        <input type="date"  class="form-control" name="end_date" value="{{$end_date}}" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-info btn-sm btn-block mt-4"> Filter Dates </button>
                </div>
            </div>
        </form>
        @if ($start_date || $end_date)
            <a href="{{route('administrator.system-logs.index')}}" class="btn btn-sm btn-outline-secondary"> Clear filters </a>
        @endif
        <br>
        <br>

        {!! $logs->links() !!}
        <table class="table table-hover">
            <thead>
                <th> Function </th>
                <th> User </th>
                <th> Role </th>
                <th> Date </th>
                <th> Time </th>
                <th> Model </th>
                <th> </th>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td> 
                            @if ($log->function == 'create')
                                <small class="text-success text-uppercase"> {{$log->function}} </small> 
                            @endif

                            @if ($log->function == 'edit')
                                <small class="text-primary text-uppercase"> {{$log->function}} </small> 
                            @endif

                            @if ($log->function == 'delete')
                                <small class="text-danger text-uppercase"> {{$log->function}} </small> 
                            @endif
                        </td>
                        <td> <small> {{$log->user->name}} </small> </td>
                        <td> <small> {{$log->user->user_instance->role->role}} </small> </td>
                        <td> <small> {{ Carbon\Carbon::parse($log->date)->format('Y-m-d')}} </small> </td>
                        <td> <small> {{ Carbon\Carbon::parse($log->time)->format('h:i:s a')}} </small> </td>
                
                        <td> <small> {{$log->model}} </small> </td>
                        <td> <button class="btn btn-sm btn-info" onclick="viewOtherInfo({{$log}})"> Other information </button> </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7"> No login report found </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {!! $logs->links() !!}
      
    </div>
</div>


<!-- Modal Other info -->
<div class="modal fade" id="other-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Log Information </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card mt-3">
                <div class="card-header">
                    <strong> User: </strong>
                </div>
                <div class="card-body">
                    <span id="user"></span>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <strong> Model / Function: </strong>
                </div>
                <div class="card-body">
                    <span id="function"></span>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <strong> Creation Date: </strong>
                </div>
                <div class="card-body">
                    <span id="creation"></span>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <strong> Data: </strong>
                </div>
                <div class="card-body">
                    <CODE id="data"></CODE>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <strong> Details: </strong>
                </div>
                <div class="card-body">
                    <span id="details"></span>
                </div>
            </div>
  
    
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
  </div>

  @include('layouts.scripts')
  <script>
      function viewOtherInfo(data){
          console.log(data);
        $('#user').html(data.user.name)
        $('#function').html(data.model +' / '+ data.function)
        $('#creation').html(data.created_at)
        $('#data').html(data.data)
        $('#details').html(data.details)
        $('#other-info').modal('show')
      }
  </script>

@endsection
