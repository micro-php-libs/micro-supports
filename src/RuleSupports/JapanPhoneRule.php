<?php

namespace MicroPhpLibs\MicroSupports\RuleSupports;
use Illuminate\Contracts\Validation\Rule;

class JapanPhoneRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!$value) {
            return true;
        }

        // 01234-5678-901 | 0123456789
        if( preg_match('/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}\z/', $value) || preg_match( '/^0[0-9]{9,10}\z/', $value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The phone number is incorrect.';
    }
}
