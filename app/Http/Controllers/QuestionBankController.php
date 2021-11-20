<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\QuestionBankRepository;

class QuestionBankController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $all_questions = app(QuestionBankRepository::class)->query()->with('user_creator')->orderBy('created_at','DESC')->paginate(10);
        return view('question-bank.all-questions',compact('all_questions'));
    }

    public function myQuestionBank(){
        $my_questions = app(QuestionBankRepository::class)->query()->with('user_creator')->whereCreator(Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
        return view('question-bank.my-questions',compact('my_questions'));
    }

    public function createMcq(){
        return view('question-bank.create.mcq');
    }

    public function createTf(){
        return view('question-bank.create.tf');
    }

    public function createSa(){
        return view('question-bank.create.sa');
    }

    public function createEssay(){
        return view('question-bank.create.essay');
    }

    public function save(Request $request){

        
        $request->validate([
            'instruction' => 'required',
            'correct_answer' => 'required_if:question_type,mcq,tf,sa',
            'option_1' => 'required_if:question_type,mcq',
            'option_2' => 'required_if:question_type,mcq'
        ]);

        $attachment = $request->attachment ? UploadHelper::uploadFile($request->attachment) : null;
  
        $data = [
            'instruction'       => $request->instruction,
            'question_type'     => $request->question_type,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'option_6'          => $request->option_6,
            'answer'            => $request->correct_answer,
            'max_points'        => $request->question_type == 'essay' ? $request->max_points : 1,
            'attachment'        => $attachment,
            'creator'           => Auth::user()->id
        ];

        $saved = app(QuestionBankRepository::class)->save($data);
    
        return redirect()->route('question-bank.show',$saved->id)->with('success', 'Question successfully created');

    }

    public function show(Question $question){
    
        return view('question-bank.show',compact('question'));
    }

    
    public function edit(Question $question){
    
        return view('question-bank.edit.'.$question->question_type,compact('question'));
    }

    public function update(Request $request){

        $request->validate([
            'instruction' => 'required',
            'correct_answer' => 'required_if:question_type,mcq,tf,sa',
            'option_1' => 'required_if:question_type,mcq',
            'option_2' => 'required_if:question_type,mcq'
        ]);

        $attachment = $request->attachment ? UploadHelper::uploadFile($request->attachment) : ($request->old_attachment ?? null);

        $data = [
            'instruction'       => $request->instruction,
            'question_type'     => $request->question_type,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'option_6'          => $request->option_6,
            'answer'            => $request->correct_answer,
            'max_points'        => $request->question_type == 'essay' ? $request->max_points : 1,
            'attachment'        => $attachment,
            'creator'           => Auth::user()->id
        ];

        app(QuestionBankRepository::class)->update($request->question_id,$data);
    
        return redirect()->route('question-bank.show',$request->question_id)->with('success', 'Question successfully updated');
    }


    public function delete(Question $question){
        $question->delete();
        return redirect()->route('question-bank.index')->with('success', 'Question successfully deleted');
    }

    

    



}
