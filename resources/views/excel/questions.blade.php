<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Question  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> Question Bank </strong></td>
        </tr>
        <tr>
            <td width="30"> <strong> Instruction </strong> </td>
            <td width="20"> <strong> Question Type </strong> </td>
            <td width="20"> <strong> Subject </strong> </td>
            <td width="20"> <strong> Option 1  </strong> </td>
            <td width="20"> <strong> Option 2 </strong> </td>
            <td width="20"> <strong> Option 3 </strong> </td>
            <td width="20"> <strong> Option 4 </strong> </td>
            <td width="20"> <strong> Option 5 </strong> </td>
            <td width="20"> <strong> Option 6 </strong> </td>
            <td width="20"> <strong> Correct Answer </strong> </td>
            <td width="20"> <strong> Points </strong> </td>
            <td width="20"> <strong> Creator </strong> </td>
            <td width="20"> <strong> Creation Date </strong> </td>
        </tr>

        @foreach ($data as $question)
            <tr>
                <td> {{strip_tags($question->instruction)}} </td>
                <td> {{$question->question_type}} </td>
                <td> {{$question->subject->course_code}} {{$question->subject->name}} </td>
                <td> {{$question->option_1}} </td>
                <td> {{$question->option_2}} </td>
                <td> {{$question->option_3}} </td>
                <td> {{$question->option_4}} </td>
                <td> {{$question->option_5}} </td>
                <td> {{$question->option_6}} </td>
                <td> {{$question->answer}} </td>
                <td> {{$question->max_points}} </td>
                <td> {{$question->user_creator->name}} </td>
                <td> {{$question->created_at}} </td>
            </tr>
        @endforeach
   
    </table>
 
  
</body>
</html>