<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Discussion Scores PDF </title>
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
    <div class="card shadow-sm mt-3 m-5">
        <div class="card-body">
            <h4> <strong> {{$discussion->name}} </strong> </h4>
            <span> {!! $discussion->description !!} </span>
            <hr>
            <ol>
                @foreach ($discussion_assignments as $assignment)
                    <li> 
                        {{$assignment->user->name}} 
                        <small> {{$assignment->user->email}} </small> 
                        - Score: {{$assignment->score}} / {{$discussion->total_score}}
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</body>

</html>