<?php

namespace App\Http\Requests\Mobile\V1\Search;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    //    public function authorize(): bool
    //    {
    //        return true;
    //    }

    public function rules(): array
    {
        return [
            'query' => 'required|string|min:3',
            'language' => 'required|string|exists:languages,code',
        ];
    }
}
