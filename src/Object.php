<?php

namespace iamsaint\yml;

use iamsaint\yml\exceptions\IncorrectRuleExceptin;
use XMLWriter;

class Object
{
    /**
     * @var XMLWriter $writer
     */
    public $writer;

    public $errors = [];

    /**
     * Object constructor.
     * @param XMLWriter|null $writer
     */
    public function __construct(XMLWriter $writer = null)
    {
        $this->writer = $writer;
    }

    /**
     * @param string $groupTag
     * @param array|Object[] $elements
     */
    public function writeElements(string $groupTag, array $elements)
    {
        $this->writer->startElement($groupTag);
        foreach ($elements as $element) {
            $element->setWriter($this->writer)->write($this->writer);
        }

        $this->writer->endElement();
    }

    /**
     * @param XMLWriter $writer
     * @return $this
     */
    public function setWriter(XMLWriter $writer)
    {
        $this->writer = $writer;
        return $this;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function validate()
    {
        $this->errors = [];
        $rules = $this->rules();
        foreach ($rules as $rule) {
            if (!is_array($rule)) {
                throw new IncorrectRuleExceptin('Rule must be array');
            }

            if (count($rule) < 2) {
                throw new IncorrectRuleExceptin('Rule is not defined');
            }

            if (!is_string($rule[1])) {
                throw new IncorrectRuleExceptin('Rule name must be a string');
            }

            $class = '\\iamsaint\yml\\validators\\' . $rule[1];

            if (!class_exists($class)) {
                throw new IncorrectRuleExceptin('Validator not found');
            }

            $attributes = is_array($rule[0]) ? $rule[0] : [$rule[0]];
            (new $class())->validate($this, $attributes, $rule[2] ? : []);
        }

        return count($this->errors) === 0;
    }

    public function addError($attribute, $text)
    {
        $this->errors[$attribute][] = $text;
    }
}