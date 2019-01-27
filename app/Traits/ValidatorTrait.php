<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidatorTrait
{
  
    public $errors; 

    public function validate($data) : bool
    {
        $validator = Validator::make($data, $this->rules);

        if($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }
}
