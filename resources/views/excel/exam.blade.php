<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Examination Result  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> Examination Result </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> Student ID </strong> </td>
            <td width="20"> {{$exam_assignment->user->student_id}}  </td>
        </tr>
        <tr>
            <td width="20"> <strong> Student Name </strong> </td>
            <td width="20"> {{$exam_assignment->user->name}}  </td>
        </tr>
        <tr>
            <td width="20"> <strong> Email </strong> </td>
            <td width="20"> {{$exam_assignment->user->email}}  </td>
        </tr>
        <tr>
            <td width="20"> <strong> Subject </strong> </td>
            <td width="20"> {{$exam_assignment->group->subject->course_code}} {{$exam_assignment->group->subject->name}} </td>
        </tr>
        <tr>
            <td width="20"> <strong> Class </strong> </td>
            <td width="20"> {{$exam_assignment->group->name}} </td>
        </tr>
        <tr>
            <td width="20"> <strong> Exam </strong> </td>
            <td width="20"> {{$exam_assignment->exam->name}} </td>
        </tr>
        <tr>
            <td width="20"> <strong> Exam Description</strong> </td>
            <td width="20"> {{$exam_assignment->exam->description}}  </td>
        </tr>
        <tr>
            <td width="20"> <strong> Exam Description</strong> </td>
            <td width="20"> {{$exam_assignment->exam->description}}  </td>
        </tr>
        <tr>
            <td width="20"> <strong> Status</strong> </td>
            <td width="20"> 
                @if ($exam_assignment->status == 1)
                <span class="text-success"> Completed </span>
                @endif
                @if ($exam_assignment->status == 2)
                    <span class="text-danger"> Late Submission </span>
                @endif
                @if ($exam_assignment->status == 4)
                <span class="text-warning"> Incomplete </span>
                @endif
            </td>
        </tr>
        
        <tr>
            <td colspan="2"> User Answer </td>
        </tr>

        <tr>
            <td colspan="2"></td>
        </tr>
        <tr > 
            <td > <strong> Question # </strong> </td>
            <td> <strong> Question Type</strong> </td>
            <td> <strong> Instruction </strong> </td>
            <td> <strong> Option A </strong> </td>
            <td> <strong> Option B </strong> </td>
            <td> <strong> Option C </strong> </td>
            <td> <strong> Option D </strong> </td>
            <td> <strong> Option E </strong> </td>
            <td> <strong> Option F </strong> </td>
            <td> <strong> Correct Answer </strong> </td>
            <td> <strong> User Answer </strong> </td>
            <td> <strong> Points </strong> </td>
        </tr>

        @foreach ($exam_assignment->user_answers as $user_answer)
        
            <tr class="text-center">
                <td width="20"> {{ $loop->index + 1}} </td>
                <td width="20"> {{ $user_answer->question->question_type}} </td>
                <td width="20"> {{ strip_tags($user_answer->question->instruction) }} </td>

                @switch($user_answer->question->question_type)
                    @case('mcq')
                    <td width="20"> {{$user_answer->question->option_1}}</td>
                    <td width="20"> {{$user_answer->question->option_2}}</td>
                    <td width="20"> {{$user_answer->question->option_3 ?? '--'}}</td>
                    <td width="20"> {{$user_answer->question->option_4 ?? '--'}}</td>
                    <td width="20"> {{$user_answer->question->option_5 ?? '--' }}</td>
                    <td width="20"> {{$user_answer->question->option_6 ?? '--'}}</td>
                    @break
                @case('tf')
                    <td width="20"> True </td>
                    <td width="20"> False </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    @break
                @case('sa')
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    @break
                @case('essay')
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    <td width="20"> -- </td>
                    @break
                @endswitch
                <td width="20"> {{ $user_answer->question->answer}} </td>
                <td width="20"> {{ strip_tags($user_answer->user_answer) }} </td>
                <td width="20"> {{ $user_answer->points }} </td>
            
            </tr>
        @endforeach
     
    </table>
    
</body>
</html>