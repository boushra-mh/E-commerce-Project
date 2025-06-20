<?php

namespace App\Http\Requests\Admin\Admin;

use App\Enums\StatusEnum;
use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends APIRequest
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
             'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|digits:10',
            'password'=>'required|min:8',
            'status'=>[Rule::enum(StatusEnum::class)]
        ];
    }
}
