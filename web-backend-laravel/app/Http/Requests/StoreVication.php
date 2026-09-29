<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVication extends FormRequest
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
            'List_Classes.*.duration' => 'required',
            'List_Classes.*.start_date' => 'required',
            'List_Classes.*.end_date' => 'required',

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'duration.required' => 'الايميل مطلوب',
            'start_date.required' => 'القسم مطلوب',
            'end_date.required' => 'السيرة الذاتية مطلوبة',
        ];
    }
}
