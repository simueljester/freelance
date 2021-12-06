@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-user-cog text-primary"></i>  Administrator </h4>
        <small class="text-muted"> <i> Access / Manage reports, logins and user accounts as system adminstrator </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('administrator.index')}}">Administrator</a></li>
            <li class="breadcrumb-item"> Export </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header">
        <strong> Exports </strong>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <th> Title </th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td> <i class="fas fa-users"></i> Users </td>
                    <td> <a href="{{route('administrator.exports.users')}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-cloud-download-alt"></i> Export </a> </td>
                </tr>
                <tr>
                    <td> <i class="fas fa-cubes"></i> Class </td>
                    <td> <a href="{{route('administrator.exports.groups')}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-cloud-download-alt"></i> Export </a> </td>
                </tr>
                <tr>
                    <td> <i class="fas fa-globe"></i> Question Bank </td>
                    <td> <a href="{{route('administrator.exports.question-bank')}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-cloud-download-alt"></i> Export </a> </td>
                </tr>
                <tr>
                    <td> <i class="fas fa-sign-in-alt"></i> Login Report </td>
                    <td> <a href="{{route('administrator.exports.login-report')}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-cloud-download-alt"></i> Export </a> </td>
                </tr>
                <tr>
                    <td> <i class="fas fa-layer-group"></i> System Logs </td>
                    <td> <a href="{{route('administrator.exports.system-logs')}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-cloud-download-alt"></i> Export </a> </td>
                </tr>
                <tr>
                    <td> <i class="fas fa-running"></i> User Activities </td>
                    <td> <a href="{{route('administrator.exports.user-activities')}}" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-cloud-download-alt"></i> Export </a> </td>
                </tr>
            </tbody>
        </table>
      
    </div>
</div>
@endsection
