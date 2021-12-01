@extends('question-bank.index')

@section('sub_content')

<form action="" class="mt-3">
    <small> Filter subject : </small>
    <button type="submit" name="subject_filter" value="0" class="btn btn-sm btn-success"> All Subject </button>
    @foreach ($all_subjects as $subject)
        <button type="submit" name="subject_filter" value="{{$subject->id}}" class="btn btn-sm btn-success"> {{$subject->name}} </button>
    @endforeach
</form>

<table class="table table-hover mt-5">
    <thead>
        <th style="width:50%"> Question </th>
        <th style="width:10%"  class="text-center"> Type </th>
        <th style="width:10%"> Difficulty </th>
        <th style="width:10%"> Subject </th>
        <th style="width:10%"> Creator </th>
        <th></th>
    </thead>
    <tbody>
        @forelse ($my_questions as $question)
            <tr>
                <td> {!! $question->instruction !!} </td>
                <td  class="text-center"> <span class="badge badge-warning text-dark p-1 text-uppercase"> {{$question->question_type}} </span> </td>
                <td>  
                    @if ($question->level == 1)
                        <span class="text-success"> Easy </span>
                    @endif
                    @if ($question->level == 2)
                        <span class="text-primary"> Medium </span>
                    @endif
                    @if ($question->level == 3)
                        <span class="text-danger"> Hard </span>
                    @endif
                </td>
                <td> {{$question->subject->name}} </td>
                <td> {{$question->user_creator->name}} </td>
                <td> 
                    <a href="{{route('question-bank.show',$question)}}" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i> View </a>
                </td>
            </tr>
        @empty
            
        @endforelse
    </tbody>
</table>
<div>
    {{ $my_questions->links() }}
</div>


@endsection

