<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Upcase implements Rule
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
          $db=array(012,0121,0126);
          foreach ($db as $key => $value) {
                    if($value===substr($value,0,4)){
                        return true;
                    }
          }
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
