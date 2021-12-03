<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use App\Subject;
use App\Question;
use App\SystemLog;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\QuestionBankRepository;

class QuestionBankController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
     
        $subject_filter = $request->subject_filter ?? 0;

        $all_questions = app(QuestionBankRepository::class)->query()->with('user_creator','subject')
        ->when($subject_filter != 0, function ($query) use ($subject_filter) {
            $query->where('subject_id', $subject_filter);
        })
        ->orderBy('created_at','DESC')
        ->paginate(10);
        
        $all_subjects = Subject::all();
        return view('question-bank.all-questions',compact('all_questions','all_subjects'));
    }

    public function myQuestionBank(Request $request){
        $subject_filter = $request->subject_filter ?? 0;
        $my_questions = app(QuestionBankRepository::class)->query()->with('user_creator','subject')
        ->when($subject_filter != 0, function ($query) use ($subject_filter) {
            $query->where('subject_id', $subject_filter);
        })
        ->whereCreator(Auth::user()->id)
        ->orderBy('created_at','DESC')
        ->paginate(10);
        $all_subjects = Subject::all();
        return view('question-bank.my-questions',compact('my_questions','all_subjects'));
    }

    public function createMcq(){
        $subjects = Subject::all();
        return view('question-bank.create.mcq',compact('subjects'));
    }

    public function createTf(){
        $subjects = Subject::all();
        return view('question-bank.create.tf',compact('subjects'));
    }

    public function createSa(){
        $subjects = Subject::all();
        return view('question-bank.create.sa',compact('subjects'));
    }

    public function createEssay(){
        $subjects = Subject::all();
        return view('question-bank.create.essay',compact('subjects'));
    }

    public function save(Request $request){

        
        $request->validate([
            'instruction' => 'required',
            'correct_answer' => 'required_if:question_type,mcq,tf,sa',
            'option_1' => 'required_if:question_type,mcq',
            'option_2' => 'required_if:question_type,mcq',
            'subject'   => 'required',
            'difficulty' => 'required'
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
            'creator'           => Auth::user()->id,
            'subject_id'        => $request->subject,
            'level'             => $request->difficulty,
        ];

        $saved = app(QuestionBankRepository::class)->save($data);
    
        return redirect()->route('question-bank.show',$saved->id)->with('success', 'Question successfully created');

    }

    public function show(Question $question){
        $question->load('subject');
        return view('question-bank.show',compact('question'));
    }

    
    public function edit(Question $question){
        $subjects = Subject::all();
        return view('question-bank.edit.'.$question->question_type,compact('question','subjects'));
    }

    public function update(Request $request){

        $request->validate([
            'instruction' => 'required',
            'correct_answer' => 'required_if:question_type,mcq,tf,sa',
            'option_1' => 'required_if:question_type,mcq',
            'option_2' => 'required_if:question_type,mcq',
            'difficulty' => 'required',
            'subject'   => 'required'
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
            'creator'           => Auth::user()->id,
            'subject_id'        => $request->subject,
            'level'             => $request->difficulty,
      
        ];

        app(QuestionBankRepository::class)->update($request->question_id,$data);
    
        return redirect()->route('question-bank.show',$request->question_id)->with('success', 'Question successfully updated');
    }


    public function delete(Question $question){

        app(BaseRepository::class)->saveLog($question,'delete');
        $question->delete();

        return redirect()->route('question-bank.index')->with('success', 'Question successfully deleted');
    }

    public function batchUpload(Request $request){
       

        $request->validate([
            'file'=> 'required|mimes:xlsx,xls'
        ]);

        //convert excel file into array
        $rows = Excel::toArray(new QuestionsImport, $request->file('file'));
        $uploaded_questions = $rows[0];


        //custom validation
        $found_null_instruction = [];
        $found_null_question_type = [];
        $found_null_option_1 = [];
        $found_null_option_2 = [];
        $found_null_correct_answer = [];
        $found_null_max_points = [];
        $found_null_difficulty = [];

        foreach($uploaded_questions as $key => $question){
            $found_null_instruction[] = $question['instruction'] == null ? $key + 2 : null ;
            $found_null_question_type[] = $question['question_type'] == null ? $key + 2  : null ;
            $found_null_option_1[] = $question['option_1'] == null ? ($question['question_type'] == 'mcq' || $question['question_type'] == 'tf' ? $key + 2 : null)  : null ;
            $found_null_option_2[] = $question['option_2'] == null ? ($question['question_type'] == 'mcq' || $question['question_type'] == 'tf' ? $key + 2 : null): null ;
            $found_null_correct_answer[] = $question['correct_answer'] == null ? ($question['question_type'] == 'essay' ? null : $key + 2 )  : null ;
            $found_null_max_points[] = $question['max_points'] == null ? $key + 2 : null ;
            $found_null_difficulty[] = $question['difficulty'] == null ? $key + 2 : null ;
        }
       
        $count_error_instruction    = array_filter($found_null_instruction);
        $count_error_q_type         = array_filter($found_null_question_type);
        $count_error_option_1       = array_filter($found_null_option_1);
        $count_error_option_2       = array_filter($found_null_option_2);
        $count_error_correct_answer = array_filter($found_null_correct_answer);
        $count_error_max_points     = array_filter($found_null_max_points);
        $count_error_difficulty     = array_filter($found_null_difficulty);

        if(!empty($count_error_instruction)){
            return redirect()->back()->with('error', 'The are null instruction found in line '.implode(",",$count_error_instruction).' . Please check your uploads');
        }
        else if(!empty($count_error_q_type)){
            return redirect()->back()->with('error', 'The are null question_type found in line '.implode(",",$count_error_q_type).' . Please check your uploads');
        }
        else if(!empty($count_error_option_1)){
            return redirect()->back()->with('error', 'The are null option_1 found in line '.implode(",",$count_error_option_1).'. Please check your uploads');
        }
        else if(!empty($count_error_option_2)){
            return redirect()->back()->with('error', 'The are null option_2 found in line '.implode(",",$count_error_option_2).' . Please check your uploads');
        }
        else if(!empty($count_error_correct_answer)){
            return redirect()->back()->with('error', 'The are null correct_answer found in line '.implode(",",$count_error_correct_answer).' . Please check your uploads');
        }
        else if(!empty($count_error_max_points)){
            return redirect()->back()->with('error', 'The are null max points found in line '.implode(",",$count_error_max_points).'. Please check your uploads');
        }
        else if(!empty($count_error_difficulty)){
            return redirect()->back()->with('error', 'The are null difficulty found in line '.implode(",",$count_error_difficulty).'. Please check your uploads');
        }else{
            return view('question-bank.check-uploads',compact('uploaded_questions'));
        }
       
    }

    public function saveBatchUpload(Request $request){
        // return $request;
        $uploaded_questions = json_decode($request->uploaded_questions);

        $data = app(QuestionBankRepository::class)->saveBatchQuestions($uploaded_questions);

        return redirect()->route('question-bank.index')->with('success', 'Questions successfully imported');
     
    }

    

    



}
