<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text' => 'required|min:10|max:3000'
        ];
    }
}
