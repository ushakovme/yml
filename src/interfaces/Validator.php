<?php

namespace iamsaint\yml\interfaces;

use iamsaint\yml\BaseObject;

/**
 * Interface Validator
 * @package iamsaint\yml\interfaces
 */
interface Validator
{
    /**
     * @param BaseObject $BaseObject
     * @param array $attributes
     * @param array $options
     */
    public function validate(BaseObject $BaseObject, array $attributes, array $options = []): void;
}