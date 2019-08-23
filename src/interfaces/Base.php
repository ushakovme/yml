<?php

namespace iamsaint\yml\interfaces;

use iamsaint\yml\BaseObject;
use iamsaint\yml\exceptions\IncorrectRuleException;
use XMLWriter;

/**
 * Interface Base
 * @package iamsaint\yml\interfaces
 */
interface Base
{
    /**
     * @param string $groupTag
     * @param array|BaseObject[] $elements
     * @param XMLWriter $writer
     */
    public function writeElements(XMLWriter $writer, string $groupTag, array $elements): void;

    /**
     * @return array
     */
    public function rules(): array;

    /**
     * @return bool
     * @throws IncorrectRuleException
     */
    public function validate(): bool;

    /**
     * @param string $attribute
     * @param string $text
     */
    public function addError($attribute, $text): void;

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void;

    /**
     * @param string $tagName
     * @param mixed $value
     * @param XMLWriter $writer
     * @param null|bool $notWriteCondition
     */
    public function writeTag($tagName, $value, $writer, $notWriteCondition = null): void;
}
