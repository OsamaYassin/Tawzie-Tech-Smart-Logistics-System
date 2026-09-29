<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFollowing extends FormRequest
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
          
            'List_Classes.*.st_name' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'st_name.required' => 'الاسم مطلوب',
        ];
    }
}
