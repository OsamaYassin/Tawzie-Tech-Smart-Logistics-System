<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacher extends FormRequest
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
            'List_Classes.*.phone' => 'required',
            'List_Classes.*.address' => 'required',
           
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'اسم الشيخ موجود',
            'phone.required' => 'الرقم مطلوب',
            'address.required' => 'العنوان مطلوب',
        ];
    }
}
