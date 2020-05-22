<?php

namespace App\Rules\Products;

use Illuminate\Contracts\Validation\Rule;

class IsCSV implements Rule
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
    public function passes($attribute, $file)
    {
        $ext = $file->getClientOriginalExtension();
        return in_array(strtolower($ext),array('csv'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Uploaded file not a CSV file.';
    }
}
