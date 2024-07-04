<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            //
            // 'email' => 'unique:users,email_address',
            'subject_name'=>'required|unique:subjects,subject_name|string|max:40',
            'specialization'=>'required|string|max:40',
            'year'=>'required|string|max:40',
            'lecturer'=>'required|string|max:40',
            'simester'=>'required|string|max:40',
            
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
            'required'=>'هذا الحقل مطلوب',
        ];
    }
}
