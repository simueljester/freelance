@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-primary"></i>  Class  </h4>
        <small class="text-muted"> <i> Class Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item active" aria-current="page"> All Groups </li>
        </ol>
    </nav>
</div>

<div class="card mt-3 shadow-sm">
    <div class="card-body">
        <strong> All class created </strong> <br>
        <small> Admin may only be able to view other teacher's created module </small>
        <table class="table table-hover mt-3">
            <thead>
                <th> Class Name </th>
                <th> Subject </th>
                <th> Creator </th>
                <th> Creation date </th>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    <tr>
                        <td> <a href="{{route('groups.show',$group)}}" class="text-primary" style="text-decoration:none;" target="_blank"> <i class="fas fa-cube"></i> {{$group->name}}  </a> </td>
                        <td> {{$group->subject->course_code}} {{$group->subject->name}} </td>
                        <td> {{$group->user_creator->name}} </td>
                        <td> {{$group->created_at->format('Y-m-d')}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
