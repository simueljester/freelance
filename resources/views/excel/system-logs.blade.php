<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> System Logs  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> System Logs </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> Date </strong> </td>
            <td width="20"> <strong> Time </strong> </td>
            <td width="20"> <strong> Model / Table  </strong> </td>
            <td width="20"> <strong> Function </strong> </td>
            <td width="20"> <strong> Data </strong> </td>
            <td width="20"> <strong> Details </strong> </td>
            <td width="20"> <strong> User </strong> </td>
        </tr>
        @foreach ($data as $log)
            <tr>
                <td> {{$log->date}} </td>
                <td> {{$log->time}} </td>
                <td> {{$log->model}} </td>
                <td> {{$log->function}} </td>
                <td> {{$log->data}} </td>
                <td> {{$log->details}} </td>
                <td> {{$log->user->name}} </td>
            </tr>
        @endforeach
    </table>
 
  
</body>
</html>