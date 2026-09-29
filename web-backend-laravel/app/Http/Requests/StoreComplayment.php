<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplayment extends FormRequest
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
            'List_Classes.*.o_id' => 'required',
            'List_Classes.*.product_name' => 'required',
            'List_Classes.*.customer_name' => 'required',
            'List_Classes.*.customer_phone' => 'required',
            'List_Classes.*.complayment' => 'required',
            'List_Classes.*.solution' => 'required',
            'List_Classes.*.status' => 'required',


        ];
    }


    public function messages()
    {
        return [
            'o_id.required' => 'معرف الطلب مطلوب',
            'product_name.required' => ' اسم المنتج مطلوب',
            'customer_name.required' => 'اسم العميل مطلوب',
            'customer_phone.required' => 'هاتف العميل مطلوب',
            'complayment.required' => 'الشكوى مطلوبة',
            'solution.required' => 'الحل المقترح مطلوب',
            'status.required' => ' حالة الشكوى مطلوبة',

        ];
    }
}
