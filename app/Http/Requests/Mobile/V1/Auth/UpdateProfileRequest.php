<?php

namespace App\Http\Requests\Mobile\V1\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "email" => 'required|email',
            'name' => 'required|string',
            'avatar' => 'nullable|file|mimes:jpg,jpeg,png,svg,aviv,gif|max:20480',
        ];

        if ($this->email !== $this->user()->email) {
            $rules['email'] = "required|email|unique:users,email";
        }

        return $rules;
    }
}
