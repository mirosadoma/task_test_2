<?php

namespace App\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class IsValidPassword implements Rule
{
    /**
     * Determine if the Length Validation Rule passes.
     *
     * @var boolean
     */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = true;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= 6 && Str::length($value) <= 25);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->numericPasses = ((bool) preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool) preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->numericPasses && $this->specialCharacterPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch (true) {
            case ! $this->uppercasePasses
                && $this->numericPasses
                && $this->specialCharacterPasses:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters and contain at least one uppercase character.');
                return __('Please Enter A Valid Password');

            case ! $this->numericPasses
                && $this->uppercasePasses
                && $this->specialCharacterPasses:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters and contain at least one number.');
                return __('Please Enter A Valid Password');

            case ! $this->specialCharacterPasses
                && $this->uppercasePasses
                && $this->numericPasses:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters and contain at least one special character.');
                return __('Please Enter A Valid Password');

            case ! $this->uppercasePasses
                && ! $this->numericPasses
                && $this->specialCharacterPasses:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters and contain at least one uppercase character and one number.');
                return __('Please Enter A Valid Password');

            case ! $this->uppercasePasses
                && ! $this->specialCharacterPasses
                && $this->numericPasses:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters and contain at least one uppercase character and one special character.');
                return __('Please Enter A Valid Password');

            case ! $this->uppercasePasses
                && ! $this->numericPasses
                && ! $this->specialCharacterPasses:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters and contain at least one uppercase character, one number, and one special character.');
                return __('Please Enter A Valid Password');

            default:
                // return ':attribute'.' '.__('must be at least').' 6 '.__('And').' '.__('must be less than').' 25 '.__('characters.');
                return __('Please Enter A Valid Password');
        }
    }
}
