<?php

namespace iamsaint\yml;

use iamsaint\yml\exceptions\IncorrectRuleException;
use iamsaint\yml\helpers\RuleHelper;
use iamsaint\yml\interfaces\Base;
use XMLWriter;
use function array_key_exists;
use function count;

/**
 * Class BaseObject
 * @package iamsaint\yml
 *
 * @property array $errors
 */
class BaseObject implements Base
{
    public $errors = [];

    /**
     * @param string $groupTag
     * @param array|BaseObject[] $elements
     * @param XMLWriter $writer
     */
    public function writeElements(XMLWriter $writer, string $groupTag, array $elements): void
    {
        $writer->startElement($groupTag);

        foreach ($elements as $element) {
            if ($element instanceof Base) {
                $element->write($writer);
            }
        }

        $writer->endElement();
    }

    /**
     * @return bool
     * @throws IncorrectRuleException
     */
    public function validate(): bool
    {
        $this->errors = [];
        $rules = $this->rules();
        foreach ($rules as $rule) {
            RuleHelper::validate($this, $rule);
        }

        return count($this->errors) === 0;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @param string $attribute
     * @param string $text
     */
    public function addError($attribute, $text): void
    {
        if (!array_key_exists($attribute, $this->errors)) {
            $this->errors[$attribute] = [];
        }

        $this->errors[$attribute][] = $text;
    }

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
    }

    /**
     * @param string $tagName
     * @param mixed $value
     * @param XMLWriter $writer
     * @param null|bool $notWriteCondition
     */
    public function writeTag($tagName, $value, $writer, $notWriteCondition = null): void
    {
        if ($notWriteCondition !== $value) {
            $writer->writeElement($tagName, $value);
        }
    }
}
