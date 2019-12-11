<?php

namespace App\Http\Requests;

class PasswordRequest extends AbstractRequest
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
            'passwordOld'=>'required|string|min:6',
            'passwordNew'=>'required|string|min:6',
            'passwordNewConfirm'=>'required|same:passwordNew',
        ];
    }
}
