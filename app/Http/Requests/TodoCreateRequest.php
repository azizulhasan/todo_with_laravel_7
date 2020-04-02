<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=> "required|max:255",
            // 'user_email' => ['required', 'string', 'email', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'A title must be less than 255 charecter'
            
        ];
    }
}
