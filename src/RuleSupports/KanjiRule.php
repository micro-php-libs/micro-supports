<?php

namespace MicroPhpLibs\MicroSupports\RuleSupports;
use Illuminate\Contracts\Validation\Rule;

class KanjiRule implements Rule
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
            return false;
        }

        if( preg_match('/^[一-龯]+|[ァ-ン]+|[ｧ-ﾝﾞﾟ]+$/', $value)) {
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
        return 'The kanji is incorrect.';
    }
}
