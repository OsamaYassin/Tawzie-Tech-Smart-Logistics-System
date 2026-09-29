<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePresolution extends FormRequest
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
            'List_Classes.*.complayment' => 'required',
            'List_Classes.*.product_name' => 'required',
            'List_Classes.*.solution' => 'required',

        ];
    }


    public function messages()
    {
        return [
            'complayment.required' => 'الشكوى مطلوبة',
            'product_name.required' => ' اسم المنتج مطلوب',
            'solution.required' => 'الحل المقترح مطلوب',

        ];
    }
}
