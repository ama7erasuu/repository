<?php

namespace App\Http\Requests\Api\V1;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'date_start' =>'nullable|date',
            'date_end' =>'nullable|date',
            'status' =>  'in:Active,Resolved',
        ];
    }
}
