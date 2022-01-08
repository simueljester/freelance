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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$group->id)}}"> {{$group->name}} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$group->name}} Grades </li>
        </ol>
    </nav>
</div>


<div class="card shadow-sm mt-3">
    <div class="card-body">
        <a href="{{route('groups.class-grades.download',$group)}}" class="btn btn-primary btn-sm"> <i class="fas fa-download"></i> Download Grades </a>
        <table class="table table-hover mt-3 table-bordered">
            <thead>
                <th> Name </th>
                <th> Email </th>
                <th> Prelim Grade </th>
                <th> Midterm Grade </th>
                <th> Finals Grade </th>
                <th> Average </th>
                <th> </th>
            
            </thead>
            <tbody>
                @forelse ($assigned_users as $user)
                    <tr>
                        <td> {{$user->user->name}} </td>
                        <td> {{$user->user->email}} </td>
                        <td> 
                            @if ($user->prelim_grades)
                               <a href="{{route('groups.class-grades.show',$user->prelim_grades)}}"> {{$user->prelim_grades->final_grade}} </a> 
                            @else
                                0
                            @endif   
                            <i class="fas fa-pencil-alt ml-3" style="cursor:pointer" onclick="gradeUser( {{$user}}, {{$user->prelim_grades ?? 1 }}, 'prelim' )"></i>
                        </td>
                        <td> 
                            @if ($user->midterm_grades)
                                <a href="{{route('groups.class-grades.show',$user->midterm_grades)}}">  {{$user->midterm_grades->final_grade}} </a> 
                            @else
                                0
                            @endif   
                            <i class="fas fa-pencil-alt ml-3" style="cursor:pointer" onclick="gradeUser({{$user}}, {{$user->midterm_grades ?? 1 }}, 'midterm' )"></i>
                        </td>
                        <td> 
                            @if ($user->finals_grades)
                                <a href="{{route('groups.class-grades.show',$user->finals_grades)}}"> {{$user->finals_grades->final_grade}} </a> 
                            @else
                                0
                            @endif 
                            <i class="fas fa-pencil-alt ml-3" style="cursor:pointer" onclick="gradeUser({{$user}},{{$user->finals_grades ?? 1}},'finals')"></i>  
                        </td>
                        <td> 
                            @if ($user->prelim_grades && $user->midterm_grades && $user->finals_grades)
                                {{ round(($user->prelim_grades->final_grade + $user->midterm_grades->final_grade + $user->finals_grades->final_grade) / 3, 2) }} 
                            @else
                                0
                            @endif  
                        </td>
                        <td>
                            <a href="{{route('groups.user-data',$user)}}" target="_blank" class="btn btn-primary btn-sm"> View Class Participation </a>
                        </td>
                      
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


{{-- Modal Grade Computation  --}}

<form action="{{route('groups.class-grades.save')}}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" name="" id="student_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <span> Group: </span>
                            <input type="text" name="" id="group_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <span> Course: </span>
                            <input type="text" name="" id="subject_name" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm ">
                            <div class="card-header bg-dark text-white"> <strong> Final Grade</strong> </div>
                            <div class="card-body text-center">
                                <strong class="Count text-muted " id="final_grade_display" style="font-size: 75px;"> 0 </strong>
                                {{-- <strong style="font-size: 90px;" class="text-success"> 0 </strong> --}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white"> <strong> Long Quizzes - </strong> <span class="badge badge-primary"> 25% </span> </div>
                    <div class="card-body">
                        <form-group>
                            <span> Score </span> / 100
                            <input type="number" name="long_quiz_score" id="long_quiz_score" max="100" min="1" value="1" class="form-control">
                        </form-group>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white"> <strong> Short Quizzes - </strong> <span class="badge badge-primary"> 15% </span> </div>
                    <div class="card-body">
                        <form-group>
                            <span> Score </span> / 100
                            <input type="number" name="short_quiz_score" id="short_quiz_score" max="100" min="1" value="1" class="form-control">
                        </form-group>
                    </div>
                </div>
           
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white"> <strong> Assessment Task - </strong> <span class="badge badge-primary"> 10% </span> </div>
                    <div class="card-body">
                        <form-group>
                            <span> Score </span> / 100
                            <input type="number" name="class_participation_score" id="class_participation_score" max="100" min="1" value="1" class="form-control">
                        </form-group>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white"> <strong> Major Examination - </strong> <span class="badge badge-primary"> 50% </span> </div>
                    <div class="card-body">
                        <form-group>
                            <span> Score </span> / 100
                            <input type="number" name="major_examination_score" id="major_examination_score" max="100" min="1" value="1" class="form-control">
                        </form-group>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-body ">
                        <button type="button" class="btn btn-block btn-primary" onclick="computeGrades()"> Compute Grades </button>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white"> Computation </div>
                    <div class="card-body">
                        <div class="form-group">
                            <span>  Long quiz 25%  </span>
                            <input readonly type="text" name="long_quiz_eg_text" id="long_quiz_eg_text" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Short Quiz 15%  </span>
                            <input readonly type="text" name="short_quiz_eg_text" id="short_quiz_eg_text" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Assessment Task 10%  </span>
                            <input readonly type="text" name="class_participation_eg_txt" id="class_participation_eg_txt" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Major Examination 50%  </span>
                            <input readonly type="text" name="major_examination_eg_txt" id="major_examination_eg_txt" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Final Grade </span>
                            <input readonly type="text" name="final_grade_txt" id="final_grade_txt" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <span>  Term </span>
                            <input type="text" name="term" id="term" class="form-control" readonly>
                            {{-- <select name="term" id="term" class="form-control">
                                <option value="prelim"> Prelim </option>
                                <option value="midterm"> Midterm </option>
                                <option value="finals"> Finals </option>
                            </select> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="user_instance_id" id="user_instance_id">
                <input type="hidden" name="group_id" id="group_id">
                <input type="hidden" name="group_assignment_id" id="group_assignment_id">
              
          
     
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
           
</form>




@endsection

@include('layouts.scripts')
<script>
    function gradeUser(group_assignment,grade,term){
        
        $('#long_quiz_score').val(grade == 1 ? 1 : grade.long_quiz_input )
        $('#short_quiz_score').val(grade == 1 ? 1 : grade.short_quiz_input)
        $('#major_examination_score').val(grade == 1 ? 1 : grade.major_examination_input)
        $('#class_participation_score').val(grade == 1 ? 1 : grade.assessment_task_input)
        $('#term').val(term)
        

        $('#long_quiz_eg_text').val(grade == 1 ? 1 : grade.long_quiz_final)
        $('#short_quiz_eg_text').val(grade == 1 ? 1 : grade.short_quiz_final)
        $('#major_examination_eg_txt').val(grade == 1 ? 1 : grade.major_examination_final)
        $('#class_participation_eg_txt').val(grade == 1 ? 1 : grade.assessment_task_final)

        $('#final_grade_txt').val(grade == 1 ? 1 : grade.final_grade)
        $('#final_grade_display').html(grade == 1 ? 1 : grade.final_grade)


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
        var quizzes_input_short
        var quizzes_input_long
        
         //inputs

        major_examination_input = parseInt($('#major_examination_score').val())
        class_participation_input = parseInt($('#class_participation_score').val())
        quizzes_input_long = parseInt($('#long_quiz_score').val())
        quizzes_input_short = parseInt($('#short_quiz_score').val())
    

        //criteria data
        var major_examination_max_points = 100
        var class_participation_max_points = 100
        var long_quiz_max_points = 100
        var short_quiz_max_points = 100

        var major_examination_percentage_value_ = 0.50
        var class_participation_value_ = 0.10
        var long_quiz_percentage_value_ = 0.25
        var short_quiz_percentage_value_ = 0.15
        
        //computation
        var major_examination_eg = (major_examination_input / major_examination_max_points) * 100
        var class_participation_eg = (class_participation_input / class_participation_max_points) * 100
        var long_quiz_eg = (quizzes_input_long / long_quiz_max_points) * 100
        var short_quiz_eg = (quizzes_input_short / short_quiz_max_points) * 100

        var total_major_examination = major_examination_percentage_value_ * major_examination_eg
        var total_class_participation = class_participation_value_ * class_participation_eg
        var total_long_quiz = long_quiz_percentage_value_ * long_quiz_eg
        var total_short_quiz = short_quiz_percentage_value_ * short_quiz_eg

        var final_grade = total_major_examination + total_class_participation + total_long_quiz + total_short_quiz

    

        $('#long_quiz_eg_text').val(total_long_quiz)
        $('#short_quiz_eg_text').val(total_short_quiz)
        $('#class_participation_eg_txt').val(total_class_participation)
        $('#major_examination_eg_txt').val(total_major_examination)

  
        $('#final_grade_txt').val(final_grade.toFixed(2))

        $('#final_grade_display').html(final_grade.toFixed(2))


        
    }


</script>
