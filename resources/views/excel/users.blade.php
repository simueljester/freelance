<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Users  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> List of Users </strong></td>
        </tr>
        <tr>
            <td width="20"> <strong> Student ID </strong> </td>
            <td width="20"> <strong> First Name </strong> </td>
            <td width="20"> <strong> Last Name </strong> </td>
            <td width="20"> <strong> Email Address  </strong> </td>
            <td width="20"> <strong> Physical Address </strong> </td>
            <td width="20"> <strong> Birthday </strong> </td>
            <td width="20"> <strong> Role </strong> </td>
            <td width="20"> <strong> Creation Date </strong> </td>
        </tr>
        @foreach ($data as $user)
            <tr>
                <td> {{$user->student_id}} </td>
                <td> {{$user->first_name}} </td>
                <td> {{$user->last_name}} </td>
                <td> {{$user->email}} </td>
                <td> {{$user->address}} </td>
                <td> {{$user->birthday}} </td>
                <td> {{$user->user_instance->role->role}} </td>
                <td> {{$user->created_at}} </td>
            </tr>
        @endforeach
    </table>
 
  
</body>
</html>