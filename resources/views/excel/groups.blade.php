<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<title> Class  </title>
<body>

    <table class="table table-hover table-striped">
        <tr>
            <td colspan="5"> <span> <strong> List of Class </strong></td>
        </tr>

        @foreach ($data as $group)
        <tr>
            <td style="background-color: #47ABFF; color:white" colspan="10"></td>
        </tr>
        <tr>
            <td width="20"> <strong> Academic Year </strong> </td>
                <td width="20"> {{$group->user_creator_instance->academicYear->name}} </td>
            </tr>
            <tr>
                <td width="20"> <strong> Subject </strong> </td>
                <td width="20"> {{$group->subject->course_code}}  {{$group->subject->name}} </td>
            </tr>
            <tr>
                <td width="20"> <strong> Class Name </strong> </td>
                <td width="20"> {{$group->name}} </td>
            </tr>
            <tr>
                <td width="20"> <strong> Description </strong> </td>
                <td width="20"> {{$group->description}} </td>
            </tr>
            <tr>
                <td width="20"> <strong> Creator </strong> </td>
                <td width="20"> {{$group->user_creator->name}} </td>
            </tr>
            <tr>
                <td width="20"> <strong> Creation Date </strong> </td>
                <td width="20"> {{$group->created_at}} </td>
            </tr>

            <tr>
                <td width="40"> <strong> Members / Enrolled </strong> </td>
            </tr>
            @foreach ($group->members as $user)
                <tr>
                    <td> {{$user->user->name}} - {{$user->user->email}}  </td>
                </tr>
            @endforeach
          
        @endforeach
     
    
    </table>
 
  
</body>
</html>