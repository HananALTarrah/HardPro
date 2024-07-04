<?php

namespace App\Http\Controllers\Admin;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewPostController extends Controller
{
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
}
