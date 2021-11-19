@extends('question-bank.index')

@section('sub_content')

<table class="table table-hover">
    <thead>
        <th style="width:60%"> Question </th>
        <th style="width:10%"> Type </th>
        <th style="width:20%"> Creator </th>
        <th></th>
    </thead>
    <tbody>
        @forelse ($all_questions as $question)
            <tr>
                <td> {!! $question->instruction !!} </td>
                <td> <span class="badge badge-warning text-dark p-1 text-uppercase"> {{$question->question_type}} </span> </td>
                <td> {{$question->user_creator->name}} </td>
                <td> 
                    <a href="{{route('question-bank.show',$question)}}" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i> View </a>
                </td>
            </tr>
        @empty
            
        @endforelse
    </tbody>
</table>



@endsection

