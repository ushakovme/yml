<?php


namespace iamsaint\yml\interfaces;

use iamsaint\yml\Object;

interface ValidatorInterface {
    public function validate(Object &$object, array $attributes, array $options = []):void;
}