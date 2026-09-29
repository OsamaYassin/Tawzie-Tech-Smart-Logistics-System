<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducts extends FormRequest
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
            'name' => 'required',
            'size' => 'required|numeric',
            'descrip' => 'required',
            'marginprice' => 'required|numeric',

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'descrip.required' => 'الوصف مطلوب',
            'size.required' => 'الحجم مطلوب',
            'size.numeric' => 'الحجم يجب ان يكون رقم',
            'marginprice.required' => 'هامش الربح يجب ان يكون رقم',
            'marginprice.numeric' => 'هامش الربح يجب ان يكون رقم',
        ];
    }
}
