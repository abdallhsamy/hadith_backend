<?php

namespace App\Http\Requests\Mobile\V1\Search;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    //    public function authorize(): bool
    //    {
    //        return true;
    //    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'subject' => 'required|string|min:3',
            'message' => 'required|string|min:3',
        ];
    }
}
