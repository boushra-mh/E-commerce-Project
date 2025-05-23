<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Validation\Rules\Enum;
class ProductSizeRequest extends APIRequest
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
            'product_id'=>'required|exists:products,id',
            'status' => ['required', new Enum(StatusEnum::class)],
            
        ];
    }
    public function messages()
    {
        return[
            'title_en.required'=>__('you_must_enter_the_title_of_product_size'),
            'title_ar.required'=>__('you_must_enter_the_title_of_product_size'),
            'status.required'=>__('please_enter_valid_status')

        ];
    }

}
