<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSizeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:sizes,name,'.$this->size->id,
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
