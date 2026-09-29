<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabMaterial extends FormRequest
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
            'List_Classes.*.name' => 'required',
            'List_Classes.*.code' => 'required',
            'List_Classes.*.units_per_kilo' => 'required',
            'List_Classes.*.grm' => 'required',


        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'اسم المادة مطلوب',
            'code.required' => ' كود المادة مطلوب',
            'units_per_kilo.required' => 'عدد الوحدات في الكيلو مطلوبة',
            'grm.required' => ' الكميةالمطلوبة في 100 جرام مطلوبة',

        ];
    }
}
