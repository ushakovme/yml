<?php

namespace iamsaint\yml\helpers;

use iamsaint\yml\exceptions\IncorrectRuleException;
use iamsaint\yml\interfaces\Validator;
use function is_array;
use function is_string;
use function count;
use function class_exists;

/**
 * Class RuleHelper
 * @package iamsaint\yml\helpers
 */
class RuleHelper
{

    /**
     * @param $rule
     * @throws IncorrectRuleException
     */
    private static function validateArray($rule): void
    {
        if (!is_array($rule)) {
            throw new IncorrectRuleException('Rule must be array');
        }
    }

    /**
     * @param $rule
     * @throws IncorrectRuleException
     */
    private static function validateString($rule): void
    {
        if (!is_string($rule[1])) {
            throw new IncorrectRuleException('Rule name must be a string');
        }
    }

    /**
     * @param $rule
     * @throws IncorrectRuleException
     */
    private static function validateDefined($rule):void
    {
        if (count($rule) < 2) {
            throw new IncorrectRuleException('Rule is not defined');
        }
    }

    /**
     * @param $rule
     * @return string
     * @throws IncorrectRuleException
     */
    private static function getRuleClass($rule): string
    {
        $class = '\\iamsaint\\yml\\validators\\'.$rule[1];

        if (!class_exists($class)) {
            throw new IncorrectRuleException('Validator not found');
        }

        return $class;
    }

    /**
     * @param $rule
     * @return bool
     * @throws IncorrectRuleException
     */
    private static function isValidRule($rule):bool
    {
        self::validateArray($rule);
        self::validateDefined($rule);
        self::validateString($rule);

        return false;
    }

    /**
     * @param $object
     * @param $rule
     * @throws IncorrectRuleException
     */
    public static function validate($object, $rule): void
    {
        if (self::isValidRule($rule)) {
            $ruleClass = self::getRuleClass($rule);

            $attributes = is_array($rule[0]) ? $rule[0] : [$rule[0]];

            $validator = new $ruleClass();

            if ($validator instanceof Validator) {
                $validator->validate($object, $attributes, $rule[2] ?: []);
            }
        }
    }
}
