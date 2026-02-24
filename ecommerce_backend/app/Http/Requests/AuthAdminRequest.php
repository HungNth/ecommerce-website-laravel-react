<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
