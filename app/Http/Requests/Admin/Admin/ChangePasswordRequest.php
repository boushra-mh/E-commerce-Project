<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\APIRequest;


class ChangePasswordRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password'=>'required',
            'new_password'=>'required|string|min:8',
            'confirmed_password'=>'required|string|min:8'
        ];
    }
}
