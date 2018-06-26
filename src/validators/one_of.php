<?php

namespace iamsaint\yml\validators;

use iamsaint\yml\interfaces\ValidatorInterface;
use iamsaint\yml\Object;

class one_of implements ValidatorInterface {

    public function validate(Object &$object, array $attributes, array $options = []):void
    {
        foreach ($attributes as $attribute){
            if( !in_array($object->$attribute, $options)) {
                $object->addError($attribute, $attribute.' must be element of ['.implode(', ', $options).']');
            }
        }
    }
}