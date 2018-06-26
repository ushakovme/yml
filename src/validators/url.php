<?php

namespace iamsaint\yml\validators;

use iamsaint\yml\interfaces\ValidatorInterface;
use iamsaint\yml\Object;

class url implements ValidatorInterface {

    public function validate(Object &$object, array $attributes, array $options = []):void
    {
        foreach ($attributes as $attribute){
            if(!filter_var($object->$attribute, FILTER_VALIDATE_URL)) {
                $object->addError($attribute, $attribute.' must be valid url');
            }
        }
    }
}