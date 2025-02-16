<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Translation\PotentiallyTranslatedString;

class CurrentPassword implements ValidationRule
{
    public function __construct(protected $match = false)
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if ($this->match) {
            if (! Hash::check($value, Auth::user()->password)) {
                $fail(trans('messages.failed.current_password_not_match'));
            }
        } else {
            if (Hash::check($value, Auth::user()->password)) {
                $fail(trans('messages.failed.password_same_current_password'));
            }
        }
    }
}
