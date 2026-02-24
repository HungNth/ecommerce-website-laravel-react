<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddColorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:colors',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
