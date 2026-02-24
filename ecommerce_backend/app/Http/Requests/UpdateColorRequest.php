<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:colors,name,'.$this->color->id,
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
