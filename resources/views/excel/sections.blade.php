<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Sections  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> Sections </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> Name </strong> </td>
            <td width="20"> <strong> Description </strong> </td>
            <td width="20"> <strong> Department </strong> </td>
            <td width="20"> <strong> Academic Year </strong> </td>
            <td width="20"> <strong> Creation Date </strong> </td>
        </tr>
        @foreach ($data as $department)
            <tr>
                <td> {{$department->name}} </td>
                <td> {{$department->description}}</td>
                <td> {{$department->department->name}}</td>
                <td> {{$department->activeAcademicYear->name}} / {{$department->activeAcademicYear->year}} / {{$department->activeAcademicYear->semester}} </td>
                <td> {{$department->created_at}} </td>
            </tr>
        @endforeach
    </table>
    
</body>
</html>