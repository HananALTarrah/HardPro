<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WriterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // ممكن أحدد هنا غارد للأوثورايزيشنولكنني سأضعها ترو يعني للكل
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           // لازم يدخّل فوتو في الكرييت أما في الأبديت فغير ضروري يدخّل 
        //   دي عشان بس نعمل الكرييت'required_without:id'
        //   دي عشان النوعmimes:jpg,jpeg,png
        // يعني الصورة مطلوبة
           'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        //    مش عاوز الاسم يزيد عن الأربعين حرف
           'name'=>'required|string|max:40',
           'type_accession'=>'required|string|max:40',
           'date_accession'=>'required|string|max:40',
           'date_exit'=>'required|string|max:40',
        //    الإيميل يمكن يكون نلبل و رح يكون إيميل يعني فيه مثلا كلمة آت
            // 'email' => 'sometimes|nullable|email',
            // لإجباره إلى إدخال آي دي لمادة موجودة بجدول المواد
            // convention name => .,mlkhkhb
            'subject_id'=>'required|exists:subjects',
            // 'password' => 'required',
            // شكل البيانات المسموح إدخالها
        ];
    }
// {{$message}}تظهر في 
    public function messages(): array
    {
        return [
            // بدال ما أكتب
            // name.max و address.max 
            // فبكتب 
            'max'=>'هذا الحقل طويل',
            // بدال ما أكتب
            // 'name.required' => 'البريد الاسم مطلوب.',
            // 'password.required' => 'كلمة المرور مطلوبة.'
            'required'=>'هذا الحقل مطلوب',
            'subject_id.exists'=>'المادة غير موجودة',
            'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
            'photo.required_without'=> 'الصورة مطلوبة'

        ];
    }
}

