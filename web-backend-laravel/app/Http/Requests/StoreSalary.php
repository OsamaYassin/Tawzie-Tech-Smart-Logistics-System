<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalary extends FormRequest
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
            'List_Classes.*.id' => 'required',
            'List_Classes.*.name' => 'required',
            'List_Classes.*.salary' => 'required',
    

        ];
    }


    public function messages()
    {
        return [
            'id.required' => 'المرتب مطلوب',
            'name.required' => 'المرتب مطلوب',
            'salary.required' => 'المرتب مطلوب',
        ];
    }
}
