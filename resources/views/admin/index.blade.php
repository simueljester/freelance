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
            <li class="breadcrumb-item">Administrator</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-sm-4">
        <a href="{{route('administrator.logins.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-sign-in-alt fa-3x text-info"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> Login Report </strong> 
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="{{route('administrator.system-logs.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-layer-group fa-3x text-info"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> System Logs  </strong> 
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="{{route('user-management.index')}}">
            <div class="card shadow-sm mt-3">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-info"></i>
                </div>
                <div class="card-footer bg-dark text-white text-center">
                    <strong class="text-white"> User Management </strong> 
                </div>
            </div>
        </a>
    </div>
</div>


@endsection
