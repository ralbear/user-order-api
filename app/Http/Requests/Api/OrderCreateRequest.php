<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'status' => 'required|in:draft,accepted,delivered',
            'amount' => 'digits_between:3,5'
        ];
    }
}
