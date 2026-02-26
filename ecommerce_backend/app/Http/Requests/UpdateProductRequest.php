<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name,'.$this->product->id,
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'color_id' => 'required',
            'size_id' => 'required',
            'desc' => 'required|max:2000',
            'thumbnail' => 'image|mimes:png,jpg,jpeg|max:2048',
            'first_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'second_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'third_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function messages(): array
    {
        return [
            'color_id.required' => 'The color field is required.',
            'size_id.required' => 'The size field is required.',
            'desc.required' => 'The description field is required.',
            'desc.max' => 'The description must not be greater than :max characters.',
            'qty.required' => 'The quantity field is required.',
            'thumbnail.max' => 'The thumbnail must not be greater than 2MB.',
            'first_image.max' => 'The first image must not be greater than 2MB.',
            'second_image.max' => 'The second image must not be greater than 2MB.',
            'third_image.max' => 'The third image must not be greater than 2MB.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'first_image.image' => 'The first image must be an image.',
            'second_image.image' => 'The second image must be an image.',
            'third_image.image' => 'The third image must be an image.',
        ];
    }
}
