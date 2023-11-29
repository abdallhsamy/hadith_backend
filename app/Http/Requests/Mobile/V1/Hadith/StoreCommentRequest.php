<?php

namespace App\Http\Requests\Mobile\V1\Hadith;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string|min:3',
            //            'hide_author'
            'parent_id' => 'nullable|exists:comments,_id',
        ];
    }
}
