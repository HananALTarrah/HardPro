<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // اذا ترو مسموح شوف و اذا فولس ما مسموح شوف
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // validation
    public function rules(): array
    {
        return [
            'question'=>'required|string',
            'option1'=>'required|max:255|string',
            'option2'=>'required|max:255|string',
            'option3'=>'required|max:255|string',
            'option4'=>'required|max:255|string',
            'option5'=>'required|max:255|string',
            'answer'=>'required|max:255|string'
        ];
    }

    // كل واصفة ممكن اتعامل معها على أنها فاليو معينة
    public function attributes(): array
    {
        return [
            'question'=>'Question',
            'option1'=>'first option',
            'option2'=>'second option',
            'option3'=>'third option',
            'option4'=>'fourth option',
            'option5'=>'fiveth option',
            'answer'=>'Answer'
        ];
    }
}
