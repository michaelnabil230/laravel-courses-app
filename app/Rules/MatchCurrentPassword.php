<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchCurrentPassword implements Rule
{
    /**
     * The Old password.
     *
     * @return string
     */
    protected string $currentPassword;

    /**
     * Create a new rule instance.
     *
     * @param string $currentPassword
     * @return void
     */
    public function __construct(string $currentPassword)
    {
        $this->currentPassword = $currentPassword;
    }

    /**
     * Create a new rule instance.
     *
     * @param  string  $currentPassword
     * @return self
     */
    public static function make(string $currentPassword): self
    {
        return new self($currentPassword);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Hash::check($value, $this->currentPassword);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is match with old password.';
    }
}
