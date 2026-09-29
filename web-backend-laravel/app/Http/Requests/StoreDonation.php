<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonation extends FormRequest
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
            'List_Classes.*.type' => 'required',
            'List_Classes.*.amount' => 'required',
            'List_Classes.*.discription' => 'required',
            'List_Classes.*.benefactor_id' => 'required',
           
        ];
    }


    public function messages()
    {
        return [
            'type.required' => 'النوع مطلوب',
            'amount.required' => 'السعر مطلوب  ',
            'discription.required' => '  الوصف مطلوب ',
            'benefactor_id.required' => 'المتبرع مطلوب ',
        ];
    }
}
