<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Rules\CurrentPassword;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ResetPasswordRequest extends Request
{
    use PasswordValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'verification_key' => [
                'required',
                'string',
                'max:255',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (! Str::contains($value, 'forgot_password')) {
                        $fail(trans('messages.failed.verification_key_enum_not_match'));
                    }
                },
            ],
            'verification_code' => ['required', 'string', 'min_digits:6', 'max_digits:6'],
            'password'          => array_merge($this->passwordRules(), [
                new CurrentPassword(),
            ]),
            'password_confirmation' => ['required'],
        ];
    }
}
