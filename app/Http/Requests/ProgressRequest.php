<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgressRequest extends FormRequest
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
            'measures' => 'required',
            'company' => 'required'
        ];
    }

    public function messages(){
      return [
        'measures.required' => '入力必須項目です。',
        'company.required' => '入力必須項目です。'
      ];
    }
}
