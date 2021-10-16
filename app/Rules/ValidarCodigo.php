<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarCodigo implements Rule
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
        return ($this->valida_codigo($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El Código de carrera no puede comenzar con 0.';
    }

    public function valida_codigo($codigo){
        $pcod = substr($codigo,0,1);
        if($pcod == 0){
            return false;
        }
        return true;
    }
}
