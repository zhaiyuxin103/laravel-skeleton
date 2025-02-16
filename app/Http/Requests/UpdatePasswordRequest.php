<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Rules\CurrentPassword;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class UpdatePasswordRequest extends Request
{
    use PasswordValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $exceptConfirmed = Arr::except($this->passwordRules(), [array_search('confirmed', $this->passwordRules())]);

        return [
            'current_password' => array_merge($exceptConfirmed, [
                new CurrentPassword(true),
            ]),
            'password' => array_merge($this->passwordRules(), [
                new CurrentPassword(false),
            ]),
            'password_confirmation' => $exceptConfirmed,
        ];
    }
}
