<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', 'max:18', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/', Password::default(), 'confirmed'];
    }
}
