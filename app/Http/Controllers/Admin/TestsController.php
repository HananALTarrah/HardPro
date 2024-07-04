<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Test;
use App\Http\Requests\TestRequest;

class TestsController extends Controller
{
    public function index(){
        // استرجاع جميع المستخدمين
        $test = Test::all();
        // إرجاع البيانات بتنسيق JSON
        return response()->json(["data"=>$question]);
    }

    public function create(){
        
        return view('admin.tests.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request -> all(),[
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()], 400);
        }
        $test = new Test();
        $test->name = $request->name;
        $test->save();

        return response()->json("Success");
    }
    
}
