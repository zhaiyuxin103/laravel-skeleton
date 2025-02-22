<?php

declare(strict_types=1);

namespace App\Http\Requests;

class FileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'file' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
            ],
            default => [],
        };
    }
}
