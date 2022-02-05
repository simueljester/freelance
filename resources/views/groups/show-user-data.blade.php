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
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Class</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group_assignment->group)}}"> {{$group_assignment->group->name}} </a></li>
            <li class="breadcrumb-item">{{$group_assignment->user->name}} Class Data</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header">
        <strong> <i class="fas fa-chalkboard-teacher"></i> {{$group_assignment->user->name}}'s Participations </strong> 
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-copy text-primary"></i> Assessment Course Requirement Participation
                        <table class="table table-hover mt-3 table-sm">
                            <thead>
                           
                                <th style="width:20%"> Score </th>
                                <th style="width:30%"> Status </th>
                                <th ></th>
                           
                            </thead>
                            <tbody>
                                @forelse ($exam_assignments as $assignment)
                                    <tr>
                                      
                                        <td> {{$assignment->score}} / {{$assignment->exam->total_score}} </td>
                                        <td> 
                                            @if ($assignment->status == 0)
                                                <h6> <span class="badge badge-secondary"> Pending </span></h6>
                                            @endif
                                            @if ($assignment->status == 1)
                                                <h6> <span class="badge badge-success"> Completed </span></h6>
                                            @endif
                                            @if ($assignment->status == 2)
                                                 <h6> <span class="badge badge-danger"> Late Submission </span></h6>
                                            @endif
                                        </td>
                                   
                                        <td> 
                                            @if ($assignment->status != 0)
                                            <a href="{{route('groups.user-group.view-exam-result',$assignment)}}" target="_blank" class="btn btn-primary btn-sm"> <i class="far fa-eye"></i> View Result </a> 
                                            <a href="{{route('groups.exam.generate-pdf',$assignment)}}" target="_blank" class="btn btn-primary btn-sm"> <i class="fas fa-download"></i> Download Result </a> 
                                            @endif
                                        </td>
                                
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"> No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-comment text-success"></i> Discussion Course Requirement Participation
                        <table class="table table-hover mt-3 table-sm">
                            <thead>
                                <th style="width:60%"> Score </th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($discussion_assignments as $assignment)
                                    <tr>
                                        <td> {{$assignment->score}} / {{$assignment->discussion->total_score}} </td>
                                        <td> <a href="{{route('groups.user-group.start-discussion',$assignment->discussion_id)}}" class="btn btn-primary btn-sm"> <i class="fas fa-comments"></i> Open Discussion </a> </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"> No data found </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header">
        <strong> <i class="fas fa-running"></i> {{$group_assignment->user->name}}'s Activities </strong> 
    </div>
    <div class="card-body">
        <center> <div class="lds-hourglass" id="loader"></div> </center>
        <table class="table table-sm table-hover">
            <thead> 
                <th> Course Requirement </th>
                <th> Details </th>
                <th> Date </th>
            </thead>
            <tbody id="ul-activities"">

            </tbody>
        </table>
     
        <button id="btn-get-activities" onclick="getActivities({{$group_assignment}},{})" hidden> Get Activity </button>
    </div>
</div>


<script>
 

    window.setInterval(function(){
                document.getElementById('loader').style.display = 'none';
                document.getElementById("btn-get-activities").click();
    }, 5000);
  
    function getActivities(group_assignment){
        var user_id = group_assignment.user_id
        var group_id = group_assignment.group_id
  
        $.ajax({
            url: '/groups/get-user-activities'  ,
            type: 'get',
            datetype:"json",
            data: { user_id: user_id, group_id: group_id},
            beforeSend: function () {
                document.getElementById('loader').style.display = 'block';
            },
            success: function(data){
                document.getElementById('loader').style.display = 'none';
                var activities = data.logs;
                var str 
                activities.forEach((data, key) => {
                    
                str += `
                    <tr>
                        <td>  ${data.module_type}  </td>
                        <td>  ${data.details}  </td>
                        <td>  ${data.created_at}  </td>
                    </tr>`
                })

                $("#ul-activities").html(str);
            }
        })
    }

</script>

<style>
    .lds-hourglass {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-hourglass:after {
  content: " ";
  display: block;
  border-radius: 50%;
  width: 0;
  height: 0;
  margin: 8px;
  box-sizing: border-box;
  border: 32px solid rgb(59, 204, 248);
  border-color: rgb(59, 204, 248) transparent rgb(59, 204, 248) transparent;
  animation: lds-hourglass 1.2s infinite;
}
@keyframes lds-hourglass {
  0% {
    transform: rotate(0);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }
  50% {
    transform: rotate(900deg);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }
  100% {
    transform: rotate(1800deg);
  }
}

</style>
@endsection
