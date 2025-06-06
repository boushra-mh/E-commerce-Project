<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends APIRequest
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
    {return [

            'email'=>'required|email',
            'password'=>'required|min:8',
           // 'phone'=>'required'
        ];
    }
}
