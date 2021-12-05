<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> User Activities  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> User Activities </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> Module </strong> </td>
            <td width="40"> <strong> Details </strong> </td>
            <td width="20"> <strong> User </strong> </td>
            <td width="20"> <strong> Group </strong> </td>
            <td width="20"> <strong> Date </strong> </td>
        </tr>
        @foreach ($data as $activity)
            <tr>
                <td> {{$activity->module_type}} </td>
                <td> {{$activity->details}} </td>
                <td> {{$activity->user->name}} - {{$activity->user->email}} </td>
                <td> {{$activity->group->name}} </td>
                <td> {{$activity->created_at}} </td>
            </tr>
        @endforeach
    </table>
 
  
</body>
</html>