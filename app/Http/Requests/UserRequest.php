<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\GenderEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    use PasswordValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'first_name'       => ['required', 'string', 'max:255'],
                'last_name'        => ['required', 'string', 'max:255'],
                'first_alias'      => ['nullable', 'required_with:last_alias', 'string', 'max:255'],
                'last_alias'       => ['nullable', 'required_with:first_alias', 'string', 'max:255'],
                'verification_key' => [
                    'required',
                    'string',
                    'max:255',
                    function (string $attribute, mixed $value, Closure $fail) {
                        if (! Str::contains($value, 'register')) {
                            $fail(trans('messages.failed.verification_key_enum_not_match'));
                        }
                    },
                ],
                'verification_code' => ['required', 'string', 'min_digits:6', 'max_digits:6'],
                'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
                'phone'             => ['sometimes', 'string', 'phone:US,CN,JP'],
                'zip'               => ['sometimes', 'string', 'max:255'],
                'address'           => ['sometimes', 'string', 'max:255'],
                'password'          => $this->passwordRules(),
                'gender'            => ['sometimes', Rule::enum(GenderEnum::class)],
                'birthday'          => ['sometimes', 'date_format:Y-m-d'],
                'introduction'      => ['sometimes', 'string', 'max:255'],
            ],
            'PATCH', 'PUT' => [
                'first_name'   => ['sometimes', 'string', 'max:255'],
                'last_name'    => ['sometimes', 'string', 'max:255'],
                'first_alias'  => ['nullable', 'string', 'max:255'],
                'last_alias'   => ['nullable', 'string', 'max:255'],
                'phone'        => ['sometimes', 'string', 'phone:US,CN,JP'],
                'zip'          => ['sometimes', 'string', 'max:255'],
                'address'      => ['sometimes', 'string', 'max:255'],
                'gender'       => ['sometimes', Rule::enum(GenderEnum::class)],
                'birthday'     => ['sometimes', 'date_format:Y-m-d'],
                'introduction' => ['sometimes', 'string', 'max:255'],
            ],
            default => [],
        };
    }

    public function attributes(): array
    {
        return [
            'verification_key'  => trans('validation.attributes.verification_key'),
            'verification_code' => trans('validation.attributes.verification_code'),
        ];
    }

    public function messages(): array
    {
        return [
            'phone.phone' => trans('validation.messages.phone.phone'),
        ];
    }
}
