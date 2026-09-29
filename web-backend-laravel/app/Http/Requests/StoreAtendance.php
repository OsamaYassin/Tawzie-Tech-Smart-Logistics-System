<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAtendance extends FormRequest
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
            
            'alhalga_id' => 'required',
           
           
        ];
    }


    public function messages()
    {
        return [
            
            'alhalga_id.required' => 'الحلقة مطلوبة',
            'alhalga.unique' => 'تم ادخال بيانات الجضور من قبل',
           
        ];
    }
}
