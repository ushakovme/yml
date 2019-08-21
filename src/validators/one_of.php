<?php

namespace iamsaint\yml\validators;

use iamsaint\yml\BaseObject;
use iamsaint\yml\interfaces\Validator;
use function in_array;

/**
 * Class one_of
 * @package iamsaint\yml\validators
 */
class one_of implements Validator
{
    /**
     * @param BaseObject $BaseObject
     * @param array $attributes
     * @param array $options
     */
    public function validate(BaseObject $BaseObject, array $attributes, array $options = []): void
    {
        foreach ($attributes as $attribute) {
            if (!in_array($BaseObject->$attribute, $options, true)) {
                $BaseObject->addError($attribute, $attribute . ' must be element of [' . implode(', ', $options) . ']');
            }
        }
    }
}
