@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-2">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-users text-primary"></i>  User Management  </h4>
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
        <div class="card bg-light">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <span> Search User </span>
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Keyword.." value="{{$keyword}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <span> Filter Role </span>
                            <select name="role" id="role" class="form-control">
                                <option value=""> All Role </option>
                                <option value="2" {{ $role == 2 ? 'selected' : null }} > Teacher </option>
                                <option value="3" {{ $role == 3 ? 'selected' : null }}> Student </option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary btn-sm mt-4 btn-block"> <i class="fas fa-search"></i> Search </button>
                        </div>
                    </div>
                    @if ($keyword || $role)
                        <a href="{{route('user-management.index')}}" class="btn btn-outline-secondary btn-sm"> Clear keyword </a>
                    @endif
                    
                </form>
            </div>
            
        </div>
        <div class="mt-3">
            <a href="{{route('user-management.create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Create New User </a>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-upload"></i> Batch Upload </button>
        </div>
        <br>
        <strong class="mt-3"> User List </strong>
        <hr>
        <table class="table table-hover">
            <thead>
                <th> Full Name </th>
                <th> Email </th>
                <th> Role </th>
                <th> Department </th>
                <th> Section </th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    @if ($user->user_instance->role_id != 1)
                        <tr>
                            <td> {{$user->last_name}}, {{$user->first_name}} </td>
                    
                            <td> {{$user->email}} </td>
                            <td> 
                                @if($user->user_instance)
                                {{$user->user_instance->role->id == '3' ? 'Student' : 'Teacher' }} 
                                @else
                                    No active role
                                @endif
                            </td>
                            <td>
                                @if ($user->user_instance->department)
                                    {{$user->user_instance->department->name}}
                                @else
                                    No department assigned
                                @endif    
                            </td>
                            <td> 
                                @if ($user->user_instance->section)
                                    {{$user->user_instance->section->name}}
                                @else
                                    No section assigned
                                @endif             
                            </td>
                            <td>
                                <a href="{{route('user-management.edit',$user)}}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> Edit </a>
                            </td>
                        </tr>
                    @endif
                  
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
            <button type="submit" class="btn btn-primary btn-sm"> Upload </button>
            </div>
        </div>
        </div>
    </div>
</form>


@endsection
