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
            <li class="breadcrumb-item"><a href="{{route('user-management.index')}}">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Check Uploads </li>
        </ol>
    </nav>
</div>

<form action="{{route('user-management.save-batch-upload')}}" method="POST">
    @csrf
    @method('POST')
    <div class="card shadow-sm mt-2">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Email Address </th>
                    <th> Address </th>
                    <th> Birthday </th>
                    <th> Role </th>
                    <th> Remarks </th>
                </thead>
                <tbody>
                    @foreach ($uploaded_users as $user)
                        <tr>
                            <td> {{$user['first_name']}} </td>
                            <td> {{$user['last_name']}} </td>
                            <td> {{$user['email']}} </td>
                            <td> {{$user['address']}} </td>
                            <td> {{ \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($user['birthday'])->format('Y-m-d') }} </td>
                            <td> {{$user['role']}} </td>
                            <td>
                                @foreach ($existing_emails as $email)
                                    @if ($email)
                                        @if ($email->email == $user['email'])
                                            <span class="text-danger"> <i class="fas fa-times-circle"></i> existing email </span> 
                                        @else
                                            <span class="text-success"> <i class="fas fa-check-circle"></i> available email </span>
                                        @endif
                                    @endif
                                @endforeach

                                @if (empty($existing_emails))
                                    <span class="text-success"> <i class="fas fa-check-circle"></i> available email </span>
                                @endif
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mt-2">
        <div class="card-body">
            <input type="hidden" name="uploaded_users" id="uploaded_users" value="{{json_encode($uploaded_users)}}">
            <a href="{{route('user-management.index')}}" class="btn btn-outline-secondary "> Cancel </a>
            @if (empty($existing_emails))
                <button type="submit" class="btn btn-primary"> Save Users </button>  
            @else
            <span class="text-danger ml-3"> <i class="fas fa-primary-circle"></i> There are errors found in your uploaded data. Please check <strong> remarks </strong> and reupload. </span>
            @endif
        </div>
    </div>
  
</form>




@endsection
