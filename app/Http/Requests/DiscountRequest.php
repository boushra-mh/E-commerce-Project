<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use App\Enums\TypeDiscountEnums;
use Illuminate\Validation\Rules\Enum;

class DiscountRequest extends APIRequest
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
            'title_en'=>'required',
            'title_ar'=>'required',
            'status'=>['required',new Enum(StatusEnum::class)],
            'type'=>['required',new Enum(TypeDiscountEnums::class)],
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'value'=>'required'

        ];
    }

    public function messages()
    {
        return
        [
            'title_en.required'=>__('you_must_enter_the_title_of_Discount'),
            'title_ar.required'=>__('you_must_enter_the_title_of_Discount'),
            'status.required'=>__('please_enter_valid_status'),
            'start_date.*'=>__('you_should_enter_valid_date'),
            'end_date.*'=>__('you_should_enter_valid_date'),
            'value.required'=>__('please_enter_valid_type')


        ];

    }
}
