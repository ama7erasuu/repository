<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|max:500',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Не заполнено обязательное поле - Name',
            'email.required' => 'Не заполнено обязательное поле - email',
            'message.required' => 'Не заполнено обязательное поле - message',
        ];

    }
}
