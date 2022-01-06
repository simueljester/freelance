<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Courses  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> Courses </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> Name </strong> </td>
            <td width="40"> <strong> Course Code </strong> </td>
            <td width="20"> <strong> Description </strong> </td>
            <td width="20"> <strong> Academic Year </strong> </td>
            <td width="20"> <strong> Creation Date </strong> </td>
        </tr>
        @foreach ($data as $subject)
            <tr>
                <td> {{$subject->name}} </td>
                <td> {{$subject->course_code}} </td>
                <td> {{$subject->description}}</td>
                <td> {{$subject->activeAcademicYear->name}} / {{$subject->activeAcademicYear->year}} / {{$subject->activeAcademicYear->semester}} </td>
                <td> {{$subject->created_at}} </td>
            </tr>
        @endforeach
    </table>
 
  
</body>
</html>