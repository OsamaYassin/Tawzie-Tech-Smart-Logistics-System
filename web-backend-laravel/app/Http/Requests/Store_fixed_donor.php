<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store_fixed_donor extends FormRequest
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
            'List_Classes.*.name' => 'required|unique:fixed_donor,name'.$this->id,
            'List_Classes.*.phone' => 'required',
            'List_Classes.*.amount' => 'required',
           
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'اسم المتبرع موجود',
            'phone.required' => 'الرقم مطلوب',
            'amount.required' => 'القيمة مطلوبة',
        ];
    }
}
