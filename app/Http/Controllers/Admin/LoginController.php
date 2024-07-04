<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
// نقوم بوضع المدير في الجدول من غير ما يسجل عن طريق التنكر مثل هذا الكود أو في الترمينل
// التنكر في فديو رقم سبعة في الدقيقة 18
//  use App\Models\Admin;
    //  public function save(){
        // $admin=new App\Models\Admin();
        // $admin->name="ahmed emam";
        // $admin->email="ahmed@gmail.com";
        // $admin->password=bcrypt("Ahmed Emam");
        // $admin->save();
    // }
    public function getLogin()
    {
        return view('admin.auth.login');
    }
    public function login(LoginRequest $request){
        // validation يعني نتأكد إذا هالبيانات مكتوبة بطريقة صح ولا غلط
        // LoginRequestقمنا بهذه الخطوة عن طريق
        // من حيث الرسائل و صحة الإدخال
        
        //سنتأكد بعد ذلك إن كانت البيانات موجودة أم لا
        
        $remember_me=$request->has('remember_me')? true :false;
// في الكونفيغ في الأوس نوع الغارد هو آدمن لذا سنبحث في جدول الآدمن و نتأكد هل الإيميل و ال
// كلمة السر المدخلتين هما موجودتان في الجدول وإذا كان كذلك فتوجه للصفحة التالية
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 
                                           'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
             return redirect() -> route('admin.dashboard');
         }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
         return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
}
