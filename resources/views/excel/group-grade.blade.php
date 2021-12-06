<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Class Grades  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> List of Class Grades </strong></td>
        </tr>
        <tr>
            <td width="20"> User </td>
            <td width="20"> Class </td>
            <td width="20"> Subject </td>
            <td width="20"> Academic Year </td>
            <td width="20"> Term </td>
            <td width="20"> Long Quiz Input </td>
            <td width="20"> Long Quiz Score </td>
            <td width="20"> Long Quiz Percentage </td>
            <td width="20"> Long Quiz Final </td>

            <td width="20"> Short Quiz Input </td>
            <td width="20"> Short Quiz Score </td>
            <td width="20"> Short Quiz Percentage </td>
            <td width="20"> Short Quiz Final </td>

            <td width="20"> Assessment Task Input </td>
            <td width="20"> Assessment Task Score </td>
            <td width="20"> Assessment Task Percentage </td>
            <td width="20"> Assessment Task Final </td>

            <td width="20"> Major Examination Input </td>
            <td width="20"> Major Examination Score </td>
            <td width="20"> Major Examination Percentage </td>
            <td width="20"> Major Examination Final </td>
            <td width="20"> Term Grade </td>
    

        </tr>
        @foreach ($data as $grade)
            <tr>
                <td> {{$grade->user->name}} </td>
                <td> {{$grade->group->name}} </td>
                <td> {{$grade->group->subject->course_code}} {{$grade->group->subject->name}} </td>
                <td> {{$grade->user_instance->academicYear->name}} </td>
                <td> {{$grade->term}} </td>

                <td> {{$grade->long_quiz_input}} </td>
                <td> {{$grade->long_quiz_score}} </td>
                <td> {{$grade->long_quiz_percentage}} </td>
                <td> {{$grade->long_quiz_final}} </td>

                <td> {{$grade->short_quiz_input}} </td>
                <td> {{$grade->short_quiz_score}} </td>
                <td> {{$grade->short_quiz_percentage}} </td>
                <td> {{$grade->short_quiz_final}} </td>

                <td> {{$grade->assessment_task_input}} </td>
                <td> {{$grade->assessment_task_score}} </td>
                <td> {{$grade->assessment_task_percentage}} </td>
                <td> {{$grade->assessment_task_final}} </td>

                <td> {{$grade->major_examination_input}} </td>
                <td> {{$grade->major_examination_score}} </td>
                <td> {{$grade->major_examination_percentage}} </td>
                <td> {{$grade->major_examination_final}} </td>

                <td> {{$grade->final_grade}} </td>

                
            </tr>
        @endforeach
     
    
    </table>
 
  
</body>
</html>