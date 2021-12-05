<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Login Report  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> Login Report </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> User </strong> </td>
            <td width="20"> <strong> Role </strong> </td>
            <td width="20"> <strong> Date  </strong> </td>
            <td width="20"> <strong> Time </strong> </td>
            <td width="20"> <strong> Ip Address </strong> </td>
            <td width="20"> <strong> User Agent </strong> </td>
            <td width="20"> <strong> Last Activity </strong> </td>
        </tr>
        @foreach ($data as $login)
            <tr>
                <td> {{$login->user->name}} </td>
                <td> {{$login->user_instance->role->role}} </td>
                <td> {{$login->date}} </td>
                <td> {{$login->time}} </td>
                <td> {{$login->ip_address}} </td>
                <td> {{$login->user_agent}} </td>
                <td> {{$login->last_activity_at}} </td>
            </tr>
        @endforeach
    </table>
 
  
</body>
</html>