<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function index(){
        // استرجاع جميع المستخدمين
        $test = Test::all();
        // إرجاع البيانات بتنسيق JSON
        return response()->json($test);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['admin_id'] = Auth::id(); // تعيين admin_id إلى رقم الآدمن المسجل حالياً

         // إنشاء الاختبار
         $test = Test::create($validated);

         // إعادة استجابة JSON
         return response()->json([
             'success' => true,
             'message' => 'Test created successfully.',
             'data' => $test
         ], 201); // 201 Created
    }

    public function destroy($id)
    {
        // جلب الاختبار المراد حذفه
        $test = Test::find($id);

        // التحقق من وجود الاختبار
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }

        // حذف الأسئلة المرتبطة
        $test->questions()->delete();

        // حذف الاختبار
        $test->delete();

        return response()->json(['message' => 'Test and its questions deleted successfully'], 200);
    }
    
}
