<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required',
            'matter' => 'required',
            'task' => 'required',
            'type' => 'required',
        ];
    }

    public function messages(){
      return [
        'file.required' => '必須項目です。',
        'matter.required' => '必須項目です。',
        'task.required' => '必須項目です。',
        'type.required' => '必須項目です。',
      ];
    }
}
