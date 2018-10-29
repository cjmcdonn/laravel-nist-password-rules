<?php

namespace LangleyFoxall\LaravelNISTPasswordRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class BreachedPasswords
 *
 * Implements the 'Dictionary words' recommendation
 * from NIST SP 800-63B section 5.1.1.2.
 */
class DictionaryWords implements Rule
{
    const DICTIONARY_FILE = '/usr/share/dict/words';

    private $words = [];

    /**
     * DictionaryWords constructor.
     */
    public function __construct()
    {
        $this->words = explode(PHP_EOL, file_get_contents(self::DICTIONARY_FILE));
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !in_array(trim($value), $this->words);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is a common dictionary word.';
    }
}