<?php

namespace App\Http\Controllers;

use Auth;
use App\Exam;
use App\User;
use DateTime;
use App\Subject;
use App\Question;
use App\SystemLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\SubjectRepository;
use App\Http\Repositories\AcademicYearRepository;
use App\Http\Repositories\QuestionBankRepository;
use App\Http\Repositories\QuestionAssignmentRepository;

class QuestionBankController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){

        $type = $request->type;
        $subject = $request->subject;
        $difficulty = $request->difficulty;
        $creator = $request->creator;
        $start_date = $request->start_date;
        $end_date = Carbon::parse($request->end_date)->addDays(1);
        $keyword = $request->keyword;
      
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;

        if($request->start_date){
            $request->validate([
                'start_date'    => 'date',
                'end_date'      => 'required|date|after_or_equal:start_date'
            ]);
        }
      
        $all_questions = app(QuestionBankRepository::class)->query()->with('user_creator','subject')
 
        ->when($type, function ($query) use ($type) {
            $query->where('question_type', $type);
        })
        ->when($subject, function ($query) use ($subject) {
            $query->where('subject_id', $subject);
        })
        ->when($difficulty, function ($query) use ($difficulty) {
            $query->where('level', $difficulty);
        })
        ->when($creator, function ($query) use ($creator) {
            $query->where('creator', $creator);
        })
        ->when($start_date, function ($query) use ($start_date,$end_date) {
            $query->where('created_at','>=', $start_date)
            ->where('created_at','<=', $end_date);
        })
        ->when($keyword, function ($query) use ($keyword,$active_ac_id) {
            $query->where('instruction', 'like', '%' . $keyword . '%')
            ->whereAcademicYearId($active_ac_id);
        })
        ->whereAcademicYearId($active_ac_id)
        ->orderBy('created_at','DESC')
        ->paginate(10);
        
        

 
        $all_subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        $all_creators = app(QuestionBankRepository::class)->query()->with('user_creator')->get()->unique('creator');

        $filters = (object)[
            'type'          => $type,
            'subject'       => Subject::find($subject),
            'creator'       => User::find($creator),
            'start_date'    => $start_date,
            'end_date'      => $request->end_date, //different format because end date added 1 day upon wherebetween
        ];
        // dd($filters);
        return view('question-bank.all-questions',compact('all_questions','all_subjects','all_creators','filters','keyword'));
    }

    public function myQuestionBank(Request $request){

        $type = $request->type;
        $subject = $request->subject;
        $difficulty = $request->difficulty;
        $creator = $request->creator;
        $start_date = $request->start_date;
        $end_date = Carbon::parse($request->end_date)->addDays(1);
        $keyword = $request->keyword;

        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;

        if($request->start_date){
            $request->validate([
                'start_date'    => 'date',
                'end_date'      => 'required|date|after_or_equal:start_date'
            ]);
        }
      
        $all_questions = app(QuestionBankRepository::class)->query()->with('user_creator','subject')
        ->whereAcademicYearId($active_ac_id)
        ->when($type, function ($query) use ($type) {
            $query->where('question_type', $type);
        })
        ->when($subject, function ($query) use ($subject) {
            $query->where('subject_id', $subject);
        })
        ->when($difficulty, function ($query) use ($difficulty) {
            $query->where('level', $difficulty);
        })
        ->when($creator, function ($query) use ($creator) {
            $query->where('creator', $creator);
        })
        ->when($start_date, function ($query) use ($start_date,$end_date) {
            $query->where('created_at','>=', $start_date)
            ->where('created_at','<=', $end_date);
        })
        ->when($keyword, function ($query) use ($keyword,$active_ac_id) {
            $query->where('instruction', 'like', '%' . $keyword . '%')
            ->whereAcademicYearId($active_ac_id);
        })
        ->whereCreator(Auth::user()->id)
        ->orderBy('created_at','DESC')
        ->paginate(10);
        
        
     
        $all_subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        $all_creators = app(QuestionBankRepository::class)->query()->with('user_creator')->get()->unique('creator');

        $filters = (object)[
            'type'          => $type,
            'subject'       => Subject::find($subject),
            'creator'       => User::find($creator),
            'start_date'    => $start_date,
            'end_date'      => $request->end_date, //different format because end date added 1 day upon wherebetween
        ];

        return view('question-bank.my-questions',compact('all_questions','all_subjects','all_creators','filters','keyword'));

    }

    public function createMcq($exam){
        $exam =  Exam::find($exam);
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        return view('question-bank.create.mcq',compact('subjects','exam'));
    }

    public function createTf($exam){
        $exam =  Exam::find($exam);
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        return view('question-bank.create.tf',compact('subjects','exam'));
    }

    public function createSa($exam){
        $exam =  Exam::find($exam);
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        return view('question-bank.create.sa',compact('subjects','exam'));
    }

    public function createEssay($exam){
        $exam =  Exam::find($exam);
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        return view('question-bank.create.essay',compact('subjects','exam'));

    }

    public function save(Request $request){
        
        $request->validate([
            'instruction' => 'required',
            'correct_answer' => 'required_if:question_type,mcq,tf,sa',
            'option_1' => 'required_if:question_type,mcq',
            'option_2' => 'required_if:question_type,mcq',
            'subject'   => 'required'
        ]);

        if($request->attachment){
            $file_size = $request->file('attachment')->getSize();
            if($file_size > 2097152){
                return redirect()->back()->with('error','File size must not exceed');
            }else{
                $attachment = UploadHelper::uploadFile($request->attachment);
            }
        }else{
            $attachment = null;
        }

        // return $request->file('attachment')->getSize();
        // $attachment = $request->attachment ? UploadHelper::uploadFile($request->attachment) : null;
  
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
            'case_sensitive'    => $request->case_sensitive ? 1 : 0,
            'attachment'        => $attachment,
            'creator'           => Auth::user()->id,
            'subject_id'        => $request->subject,
            'level'             => 1,
            'academic_year_id' => app(AcademicYearRepository::class)->getActiveAcademicYear()->id
        ];

        $saved = app(QuestionBankRepository::class)->save($data);

        //if creation of question is inside exam, then automatically assign to that exam
        if($request->exam){
            $exam = json_decode($request->exam);
            $exam_found = Exam::with('group')->find($exam->id);
       

            if($saved->subject_id == $exam_found->group->subject_id){
                $exam_found->total_score =   $exam_found->total_score + $saved->max_points;
                $exam_found->save();
                app(QuestionAssignmentRepository::class)->assignSingleQuestions($exam,$saved);
                return redirect()->route('groups.exam.examination-assignment.index',$exam->id)->with('success', 'Question successfully created');
            }else{
                return redirect()->route('groups.exam.examination-assignment.index',$exam->id)->with('error', 'Question you are trying to create is not from this subject.');
            }
       
        
        }else{
            return redirect()->route('question-bank.show',$saved->id)->with('success', 'Question successfully created');
        }
    
     

    }

    public function show(Question $question){

        $question->load('subject');
        return view('question-bank.show',compact('question'));

    }

    
    public function edit(Question $question){
        $active_ac_id = app(AcademicYearRepository::class)->getActiveAcademicYear()->id;
        $subjects = app(SubjectRepository::class)->query()->whereAcademicYearId($active_ac_id)->get();
        return view('question-bank.edit.'.$question->question_type,compact('question','subjects'));
    }

    public function update(Request $request){

        $request->validate([
            'instruction' => 'required',
            'correct_answer' => 'required_if:question_type,mcq,tf,sa',
            'option_1' => 'required_if:question_type,mcq',
            'option_2' => 'required_if:question_type,mcq',
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
            'case_sensitive'    => $request->case_sensitive ? 1 : 0,
            'attachment'        => $attachment,
            'creator'           => Auth::user()->id,
            'subject_id'        => $request->subject,
            'level'             => 1,
      
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

    public function corrects(Request $request){
        $keyword = $request->keyword;
        $exam_answers = ExamAnswer::all();
        dd($exam_answers);
        return view('question-bank.corrects',compact('keyword'));
    }

    

    



}
