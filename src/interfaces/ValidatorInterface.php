<?php

namespace iamsaint\yml\interfaces;

use iamsaint\yml\BaseObject;

/**
 * Interface ValidatorInterface
 * @package iamsaint\yml\interfaces
 */
interface ValidatorInterface
{
    /**
     * @param BaseObject $BaseObject
     * @param array $attributes
     * @param array $options
     */
    public function validate(BaseObject $BaseObject, array $attributes, array $options = []): void;
}