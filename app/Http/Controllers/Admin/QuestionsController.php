<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;use Illuminate\Support\Facades\Validator;

use App\Http\Requests\QuestionRequest;

class QuestionsController extends Controller
{
    public function index()
    {
           // استرجاع جميع المستخدمين
           $question = Question::all();
           // إرجاع البيانات بتنسيق JSON
           return response()->json($question);
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request -> all(),[
            'question' => 'required',
            'option1'  => 'required',
            'option2'  => 'required',
            'option3'  => 'required',
            'option4'  => 'required',
            'option5'  => 'required',
            'answer'   => 'required',
        ]);        
        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()], 400);
        }
        $question = new Question();
        $question->question = $request->question;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->option5 = $request->option5;
        $question->answer = $request->answer;
        $question->save();

        return response()->json("Success");
    }

    public function update(Request $request, $id)
    {
         // التحقق من البيانات
         $request->validate([
            'question' => 'required',
            'option1'  => 'required',
            'option2'  => 'required',
            'option3'  => 'required',
            'option4'  => 'required',
            'option5'  => 'required',
            'answer'   => 'required',
        ]);

        // العثور على المستخدم وتحديث بياناته
        $question = Question::findOrFail($id);
        $question->question = $request->input('question');
        $question->option1 = $request->input('option1');
        $question->option2 = $request->input('option2');
        $question->option3 = $request->input('option3');
        $question->option4 = $request->input('option4');
        $question->option5 = $request->input('option5');
        $question->answer = $request->input('answer');
        $question->save();
        return response()->json(['message' => 'User updated successfully!', 'question' => $question]);
    }

    public function destroy($id)
    {
        // العثور على السؤال وحذفه
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Question deleted successfully!']);
    }
}