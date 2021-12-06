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
            <li class="breadcrumb-item">Login Report</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header">
        <strong> Login Report </strong>
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
                    <button class="btn btn-primary btn-sm btn-block mt-4"> Filter Dates </button>
                </div>
            </div>
        </form>
        @if ($start_date || $end_date)
            <a href="{{route('administrator.logins.index')}}" class="btn btn-sm btn-outline-secondary"> Clear filters </a>
        @endif
        <br>
        <br>
        {!! $logins->links() !!}
        <table class="table table-hover">
            <thead>
                <th> User </th>
                <th> Role </th>
                <th> Date </th>
                <th> Time </th>
                <th> Ip address </th>
                <th> User Agent </th>
                <th> Last Activity </th>
            </thead>
            <tbody>
                @forelse ($logins as $login)
                    <tr>
                        <td> <small> {{$login->user->name}} </small> </td>
                        <td> <small> {{$login->user->user_instance->role->role}} </small> </td>
                        <td> <small> {{ Carbon\Carbon::parse($login->date)->format('Y-m-d')}} </small> </td>
                        <td> <small> {{ Carbon\Carbon::parse($login->time)->format('h:i:s a')}} </small> </td>
                        <td> <small> {{$login->ip_address}} </small> </td>
                        <td> 
                            
                            <?php 

                                //First get the platform?
                                if (preg_match('/linux/i', $login->user_agent)) {
                                    $platform = 'Linux';
                                }
                                elseif (preg_match('/macintosh|mac os x/i', $login->user_agent)) {
                                    $platform = 'Mac';
                                }
                                elseif (preg_match('/windows|win32/i', $login->user_agent)) {
                                    $platform = 'Windows';
                                }

                                // Next get the name of the useragent yes seperately and for good reason
                                if(preg_match('/MSIE/i',$login->user_agent) && !preg_match('/Opera/i',$login->user_agent))
                                {
                                    $bname = 'Internet Explorer';
                                    $ub = "MSIE";
                                }
                                elseif(preg_match('/Firefox/i',$login->user_agent))
                                {
                                    $bname = 'Mozilla Firefox';
                                    $ub = "Firefox";
                                }
                                elseif(preg_match('/Chrome/i',$login->user_agent))
                                {
                                    $bname = 'Google Chrome';
                                    $ub = "Chrome";
                                }
                                elseif(preg_match('/Safari/i',$login->user_agent))
                                {
                                    $bname = 'Apple Safari';
                                    $ub = "Safari";
                                }
                                elseif(preg_match('/Opera/i',$login->user_agent))
                                {
                                    $bname = 'Opera';
                                    $ub = "Opera";
                                }
                                elseif(preg_match('/Netscape/i',$login->user_agent))
                                {
                                    $bname = 'Netscape';
                                    $ub = "Netscape";
                                }
                            ?>
                            <small> <i class="fas fa-desktop"></i> {{$platform}} / <i class="fas fa-globe"></i> {{$bname}}  </small> 
                        </td>
                        <td> <small> {{ Carbon\Carbon::parse($login->last_activity_at)->diffForHumans()}}  </small> </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7"> No login report found </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {!! $logins->links() !!}
    </div>
</div>
@endsection
