<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

use App\Models\NationalExam;

class NationalExamsController extends Controller
{
    
    public function index(){
      $nationalexams = NationalExam::all();
      return response()->json(['data' => $nationalexams], 200);
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:10000', // الحد الأقصى 10MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // تخزين الملف
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('nationalexams', 'public');

            // حفظ معلومات الملف في قاعدة البيانات
            $nationalExam = new NationalExam();
            $nationalExam->name = $fileName;
            $nationalExam->path = $filePath;
            $nationalExam->save();

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully.',
                'file' => [
                    'name' => $fileName,
                    'path' => $filePath
                ]
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'File upload failed.'
        ], 500);
    }

    public function destroy(Request $request, $id)
    {
        // إيجاد الملف في قاعدة البيانات
        $nationalExam = NationalExam::find($id);

        if (!$nationalExam) {
            return response()->json([
                'success' => false,
                'message' => 'File not found.'
            ], 404);
        }

        // حذف الملف من التخزين
        Storage::disk('public')->delete($nationalExam->path);

        // حذف السجل من قاعدة البيانات
        $nationalExam->delete();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully.'
        ], 200);
    }      
}
