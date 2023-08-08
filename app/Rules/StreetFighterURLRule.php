<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StreetFighterURLRule implements Rule
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
    public function passes($attribute, $value)
    {
        // Formato https://www.street-fighter.com/ ou https://street-fighter.com/.
        return preg_match('/^https:\/\/(www\.)?street-fighter\.com\//', $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Endereço eletrônico de perfil inválido ou vazio.';
    }
}
