<?php

namespace App\Http\Requests;

use App\Enums\ColorsStatus;
use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rules\Enum;

class ColorRequest extends APIRequest
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
        'title_en'=>'required|string',
        'title_ar'=>'required|string',
        'status_en' => ['required', new Enum(ColorsStatus::class)],
        'status_ar' => ['required', new Enum(ColorsStatus::class)],
        ];
    }

    public function messages()
    {
        return
        [
            'title_en.required' => __('you_must_enter_the_title_of_color'),
            'title_ar.required' => __('you_must_enter_the_title_of_color'),
            'status_en.required'=>__('you_should_enter_the_status_of_color'),
            'status_ar.required'=>__('you_should_enter_the_status_of_color'),

        ];
    }
}
