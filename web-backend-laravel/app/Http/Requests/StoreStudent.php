<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudent extends FormRequest
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
            'List_Classes.*.name' => 'required|unique:students,name'.$this->id,
            'List_Classes.*.age' => 'required',
            'List_Classes.*.address' => 'required',
           
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'اسم الطالب موجود',
            'age.required' => 'العمر مطلوب',
            'address.required' => 'العنوان مطلوب',
        ];
    }
}
