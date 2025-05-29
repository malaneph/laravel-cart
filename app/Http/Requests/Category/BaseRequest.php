<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', Rule::exists('categories', 'id')],
        ];
    }
}
