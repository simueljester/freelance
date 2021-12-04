@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted"> <i class="fas fa-cubes text-info"></i>  Groups  </h4>
        <small class="text-muted"> <i> Group Assignments </i>  </small>
    </div>
</div>

<div class="card shadow-sm mt-3 p-1"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group->id)}}"> {{$group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$group->name}} Grades </li>
        </ol>
    </nav>
</div>


<div class="card shadow-sm mt-3">
    <div class="card-body">
        <table class="table table-hover mt-3 table-bordered">
            <thead>
                <th> Name </th>
                <th> Email </th>
                <th> Prelim Grade </th>
                <th> Midterm Grade </th>
                <th> Final Grade </th>
                <th> Average </th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($assigned_users as $user)
                    <tr>
                        <td> {{$user->user->name}} </td>
                        <td> {{$user->user->email}} </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> <button type="button" class="btn btn-info btn-sm" onclick="gradeUser({{$user}})"> Update </button> </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"> No users assigned </td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>


<form action="#" method="POST" enctype="multipart/form-data">
    @csrf
    @method("POST")
   
    <!-- Modal -->
    <div class="modal fade" id="gradeUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Grade User </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <span> Student Name: </span>
                            <input type="text" name="" id="student_name" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <span> Group: </span>
                            <input type="text" name="" id="group_name" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <span> Subject: </span>
                            <input type="text" name="" id="subject_name" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm ">
                            <div class="card-header"> <strong> Final Grade</strong> </div>
                            <div class="card-body text-center">
                                <strong class="Count text-muted " id="final_grade_display" style="font-size: 90px;"> 0 </strong>
                                {{-- <strong style="font-size: 90px;" class="text-success"> 0 </strong> --}}
                            </div>
                        </div>
                    </div>
                </div>
             
                <div class="card shadow-sm mt-3">
                    <div class="card-header"> <strong> Major Examination - </strong> <span class="badge badge-secondary"> 50% </span> </div>
                    <div class="card-body">
                        <form-group>
                            <span> Score </span> / 100
                            <input type="number" name="major_examination_score" id="major_examination_score" max="100" min="1" value="1" class="form-control">
                        </form-group>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-header"> <strong> Class Participation - </strong> <span class="badge badge-secondary"> 50% </span> </div>
                    <div class="card-body">
                        <form-group>
                            <span> Score </span> / 100
                            <input type="number" name="class_participation_score" id="class_participation_score" max="100" min="1" value="1" class="form-control">
                        </form-group>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <button type="button" class="btn btn-block btn-info" onclick="computeGrades()"> Compute Grades </button>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-header"> </div>
                    <div class="card-body">
                        <div class="form-group">
                            <span>  Major Examination 50%  </span>
                            <input disabled type="text" name="major_examination_eg_txt" id="major_examination_eg_txt" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Class Participation 50%  </span>
                            <input disabled type="text" name="class_participation_eg_txt" id="class_participation_eg_txt" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Final Grade </span>
                            <input disabled type="text" name="final_grade_txt" id="final_grade_txt" class="form-control"> 
                        </div>
                     
                    </div>
                </div>
            
               
            </div>
            <div class="modal-footer">
                <input type="hidden" name="group_assignment_id" id="group_assignment_id">
                <input type="hidden" name="group_id" id="group_id">
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="user_instance_id" id="user_instance_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
           
</form>




@endsection

@include('layouts.scripts')
<script>
    function gradeUser(group_assignment){
    
        $('#major_examination_score').val(1)
        $('#class_participation_score').val(1)

        $('#major_examination_eg_txt').val(0)
        $('#class_participation_eg_txt').val(0)
        $('#final_grade_txt').val(0)

        $('#final_grade_display').html(0)


        $('#group_assignment_id').val(group_assignment.id)
        $('#group_id').val(group_assignment.group_id)
        $('#user_id').val(group_assignment.user_id)
        $('#user_instance_id').val(group_assignment.user_instance_id)

        $('#student_name').val(group_assignment.user.name)
        $('#group_name').val(group_assignment.group.name)
        $('#subject_name').val(group_assignment.group.subject.name)
        
        $('#gradeUserModal').modal('show')
    }

    function computeGrades(){
        var major_examination_input
        var class_participation_input
        
         //inputs

        major_examination_input = parseInt($('#major_examination_score').val())
        class_participation_input = parseInt($('#class_participation_score').val())

        //criteria data
        var major_examination_max_points = 100
        var class_participation_max_points = 100

        var major_examination_percentage_value_ = 0.50
        var major_examination_percentage_value_ = 0.50
        
        //computation
        var major_examination_eg = (major_examination_input / major_examination_max_points) * 100
        var class_participation_eg = (class_participation_input / class_participation_max_points) * 100

        var total_major_examination = major_examination_percentage_value_ * major_examination_eg
        var class_participation_examination = major_examination_percentage_value_ * class_participation_eg

        var final_grade = total_major_examination + class_participation_examination



        $('#major_examination_eg_txt').val(total_major_examination)
        $('#class_participation_eg_txt').val(class_participation_examination)
        $('#final_grade_txt').val(final_grade)

        $('#final_grade_display').html(final_grade)


        
    }


</script>
