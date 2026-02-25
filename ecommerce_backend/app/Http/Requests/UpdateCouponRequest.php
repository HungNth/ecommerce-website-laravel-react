<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:coupons,name,'.$this->coupon->id,
            'discount' => 'required',
            'valid_until' => 'required',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function messages()
    {
        return [
            'valid_until.required' => 'The coupon validity is required',
        ];
    }
}
