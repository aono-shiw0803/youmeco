<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
          'matter' => 'required',
          'matter_2' => 'required',
          'task' => 'required',
          'staff' => 'required',
          'hour' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
        ];
    }

    public function messages(){
      return [
        'matter.required' => '選択必須項目です。',
        'matter_2.required' => '選択必須項目です。',
        'task.required' => '選択必須項目です。',
        'staff.required' => '選択必須項目です。',
        'hour.required' => '入力必須項目です。',
        'start_date.required' => '入力必須項目です。',
        'end_date.required' => '入力必須項目です。',
      ];
    }
}
