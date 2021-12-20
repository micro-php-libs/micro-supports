<?php


namespace MicroPhpLibs\MicroSupports\RuleSupports;

use Illuminate\Contracts\Validation\Rule;

class Base64Rule implements Rule
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
        if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The base64 is incorrect.';
    }
}
