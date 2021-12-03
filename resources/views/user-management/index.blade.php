@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-users text-info"></i>  User Management  </h4>
        <small class="text-muted"> <i> Create, Update and Delete user accounts </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-2 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">User Management</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-2">
    <div class="card-body">
        <div>
            <a href="{{route('user-management.create')}}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i> Create New User </a>
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-upload"></i> Batch Upload </button>
        </div>
        <br>
        <strong class="mt-3"> User List </strong>
        <hr>
        <table class="table table-hover">
            <thead>
                <th> Name </th>
                <th> Email </th>
                <th> Role </th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td> 
                            @if($user->user_instance)
                               {{$user->user_instance->role->role}} 
                            @else
                                No active role
                            @endif
                        </td>
                        <td>
                            <a href="{{route('user-management.edit',$user)}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> Edit </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"> No user created </td>
                    </tr>
                @endforelse
         
            </tbody>
        </table>
    </div>
</div>

<form action="{{route('user-management.batch-upload')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
   <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Batch User Upload </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <a href="{{route('downloads.template','user_template.xlsx')}}"> Download Template </a>
                <div class="form-group mt-3">
                    <span> File </span><br>
                    <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv"  required>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info btn-sm"> Upload </button>
            </div>
        </div>
        </div>
    </div>
</form>


@endsection
