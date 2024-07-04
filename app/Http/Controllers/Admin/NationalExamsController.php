<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

use App\Models\NationalExam;
use App\Http\Requests\NationalExamRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NationalExamsController extends Controller
{
    
    // لعرض جميع المواد
    public function index(){
      $nationalexams = NationalExam::all();
      return response()->json(['data' => $nationalexams], 200);
        // $nationalexams= NationalExam::get();
        //  all();
        //  return view('admin.nationalexams.index' ,compact('nationalexams'));
    }

    // للانتقال لصفحة فورم إضافة مادة
    public function create(){
        return view('admin.nationalexams.create');
    }

    //لإنشاء مادة و تخزينها في قاعدة البيانات 
    public function store(NationalExamRequest $request)
    {
      // if($request->has(file)){
      //   $file=$request->file('file');
      //   $extension = $file->getClientOriginalExtension();
      //   $name = time().'.'.$extension;
      //   $file->move('nationalexams',$name);
      // }
      //   $path = $request->file('file')->storeAs(
      //     'nationalexams',
      //     $request->user()->id,
      //     'public'
      // );

    if ($request->file('file')) {
      $fileName = $request->file('file')->getClientOriginalName();
      $filePath = $request->file('file')->store('nationalexams', 'public');
      $file = new NationalExam();
      $file->name = $fileName;
      $file->path = $filePath;
      $file->save();
      return back()->with('success', 'File uploaded successfully.')->with('file', $filePath);
    }

    return back()->with('error', 'File upload failed.');
      
       // عملية الاب لود
        // $data=$request->validated();
        // $data['file']=$request->file('file')->store('public/nationalexams');

        // $nationalexam=NationalExam::create( $data);
        // if(!$nationalexam)
        // {
          //  return redirect()->route('admin.nationalexams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }
        // return redirect()->route('admin.nationalexams')->with(['success' => 'تم الحفظ بنجاح']); 

    }
    public function edit(string $id)
    {
        $nationalexam=NationalExam::find($id);
        return view('admin.nationalexams.edit',compact('nationalexam'));
        
    }
    
    public function show(string $id)
    {
      $nationalexam = NationalExam::findOrFail($id);
      return response()->json(['data' => $nationalexam], 200);
        // $nationalexam=NationalExam::find($id);
        // return view('admin.nationalexams.show',compact('nationalexam'));
    }

    public function update(NationalExamRequest $request,string $id)
    {
        $nationalexams=NationalExam::find($id);
        $data=$request->validated();
        if($request->hasFile('file')){

            // عم نعمل حذف للمسار القديم
        if(!empty($nationalexams->file)&& Storage::exists($nationalexams->file))
          {
            Storage::delete($nationalexams->file);
          }
        //   عم نحط المسار الجديد مكان القديم
          $data['file']=$request->file('file')->store('nationalexams');
        }
        //  في حال لم أدخل ملف جديد فيبقى القديم
        else{unset($data['file']);}
        $nationalexams->update($data);
        return view('admin.nationalexams.index');
    }

      //  الديليت من نوع بوست  ديليت عشان يقدر يوصل لدستروي
      public function destroy(string $id)
      {
          // درس27
          // $test=Test::find($id);
          // $test->delete();
          // او
          NationalExam::where('id',$id)->delete();
          return redirect('admin.nationalexams.index');
          // درس27
          // return 'record delete  id=' . $id;
      }
  
      public function forceDelete(string $id)
      {
        $nationalexams=NationalExam::find($id);
          if(!empty($nationalexams->file)&& Storage::exists($nationalexams->file))
          {
            Storage::delete($nationalexams->file);
          }
          $nationalexams->forceDelete();
          return view('admin.nationalexams.index');
         
      }
      
}
