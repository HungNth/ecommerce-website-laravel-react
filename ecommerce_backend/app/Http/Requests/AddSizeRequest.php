<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSizeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:sizes',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
