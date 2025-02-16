<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\VerificationCodeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class VerificationCodeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'type'  => ['required', 'string', Rule::enum(VerificationCodeEnum::class)],
                    'email' => ['required', 'string', 'email'],
                ];

                match ($this->input('type')) {
                    VerificationCodeEnum::REGISTER->value        => $rules['email'][] = Rule::unique('users')->whereNull('deleted_at'),
                    VerificationCodeEnum::FORGOT_PASSWORD->value => $rules['email'][] = Rule::exists('users')->whereNull('deleted_at'),
                    default                                      => [],
                };

                break;

            default:
                $rules = [];
                break;
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'type' => trans('validation.attributes.verification_code_enum'),
        ];
    }
}
