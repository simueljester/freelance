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
            <li class="breadcrumb-item"><a href="{{route('groups.show',$grade->group->id)}}"> {{$grade->group->name}} </a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.class-grades.index',$grade->group)}}"> {{$grade->group->name}} Grades </a></li>
            <li class="breadcrumb-item active text-capitalize" aria-current="page"> Show  {{$grade->term}} Grade </li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mt-3"> 
    <div class="card-body">
        <span style="font-size: 18px"> <strong class="text-uppercase"> {{$grade->term}} : {{$grade->final_grade}} </strong> </span>
        <hr>
        <i class="fas fa-user"></i> {{$grade->user->name}}
        &nbsp&nbsp 
        <i class="fas fa-cube"></i> {{$grade->group->name}}
        &nbsp&nbsp 
        <i class="fas fa-book-reader"></i> {{$grade->group->subject->name}}
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3"> 
            <div class="card-body">
                <table class="table table-hover  table-sm">
                    <tr>
                        <td colspan="2" class="bg-info text-white"> <strong> Long Quiz </strong> </td>
                    </tr>
                    <tr>
                        <td> Teacher / Instructor Input </td>
                        <td> {{$grade->long_quiz_input}} </td>
                    </tr>
                    <tr>
                        <td> Score / Pts</td>
                        <td> {{$grade->long_quiz_score}} </td>
                    </tr>
                    <tr>
                        <td> Percentage Equivalent </td>
                        <td> {{$grade->long_quiz_percentage}} % </td>
                    </tr>
                    <tr>
                        <td> Final Long Quiz </td>
                        <td> <strong> {{$grade->long_quiz_final}} </strong>  </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card shadow-sm mt-3"> 
            <div class="card-body">
                <table class="table table-hover  table-sm">
                    <tr>
                        <td colspan="2" class="bg-info text-white"> <strong> Assessment Task </strong> </td>
                    </tr>
                    <tr>
                        <td> Teacher / Instructor Input </td>
                        <td> {{$grade->assessment_task_input}} </td>
                    </tr>
                    <tr>
                        <td> Score / Pts</td>
                        <td> {{$grade->assessment_task_score}} </td>
                    </tr>
                    <tr>
                        <td> Percentage Equivalent </td>
                        <td> {{$grade->assessment_task_percentage}} % </td>
                    </tr>
                    <tr>
                        <td> Final Assessment Task </td>
                        <td> <strong> {{$grade->assessment_task_final}} </strong>  </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow-sm mt-3 "> 
            <div class="card-body">
                <table class="table table-hover  table-sm">
                    <tr>
                        <td colspan="2" class="bg-info text-white"> <strong> Short Quiz </strong> </td>
                    </tr>
                    <tr>
                        <td> Teacher / Instructor Input </td>
                        <td> {{$grade->short_quiz_input}} </td>
                    </tr>
                    <tr>
                        <td> Score / Pts</td>
                        <td> {{$grade->short_quiz_score}} </td>
                    </tr>
                    <tr>
                        <td> Percentage Equivalent </td>
                        <td> {{$grade->short_quiz_percentage}} % </td>
                    </tr>
                    <tr>
                        <td> Final Short Quiz </td>
                        <td> <strong> {{$grade->short_quiz_final}} </strong>  </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card shadow-sm mt-3"> 
            <div class="card-body">
                <table class="table table-hover  table-sm">
                    <tr>
                        <td colspan="2" class="bg-info text-white"> <strong> Major Examination </strong> </td>
                    </tr>
                    <tr>
                        <td> Teacher / Instructor Input </td>
                        <td> {{$grade->major_examination_input}} </td>
                    </tr>
                    <tr>
                        <td> Score / Pts</td>
                        <td> {{$grade->major_examination_score}} </td>
                    </tr>
                    <tr>
                        <td> Percentage Equivalent </td>
                        <td> {{$grade->major_examination_percentage}} % </td>
                    </tr>
                    <tr>
                        <td> Final Major Examination </td>
                        <td> <strong> {{$grade->major_examination_final}} </strong>  </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>







@endsection
