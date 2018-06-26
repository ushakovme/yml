<?php

namespace iamsaint\yml\validators;

use iamsaint\yml\interfaces\ValidatorInterface;
use iamsaint\yml\Object;

class required implements ValidatorInterface {

    public function validate(Object &$object, array $attributes, array $options = []):void
    {
        foreach ($attributes as $attribute){
            if( strlen(trim( (string) $object->$attribute )) === 0) {
                $object->addError($attribute, $attribute.' cannot be empty');
            }
        }
    }
}