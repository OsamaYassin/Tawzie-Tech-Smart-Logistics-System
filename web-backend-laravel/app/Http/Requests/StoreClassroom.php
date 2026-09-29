<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
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
            'List_Classes.*.name' => 'required|unique:alhalga,name'.$this->id,
          
           
        ];
    }


    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => 'اسم الحلقة موجود',
           
        ];
    }
}
