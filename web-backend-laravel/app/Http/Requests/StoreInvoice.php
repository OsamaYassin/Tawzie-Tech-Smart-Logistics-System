<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoice extends FormRequest
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
            'List_Classes.*.amount' => 'required',
            'List_Classes.*.discription' => 'required',
           
           
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'amount.required' => 'السعر مطلوب  ',
            'discription.required' => '  الوصف مطلوب ',
         
        ];
    }
}
