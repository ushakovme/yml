<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;

/**
 * Class Shop
 * @package iamsaint\yml\components
 *
 * @property string $key
 * @property string $groupKey
 * @property BaseObject|string $value
 * @property array $attributes
 */
class Tag extends BaseObject
{
    public $key;
    public $groupKey;
    public $value;
    public $attributes = [];

    public function write(): void
    {
        $this->writer->startElement($this->key);

        foreach ($this->attributes as $key => $value) {
            $this->writer->writeAttribute($key, $value);
        }

        if($this->value instanceof BaseObject) {
            $this->writer->writeElement($this->groupKey, $this->value);
        } else {
            $this->writer->text($this->value);
        }

        $this->writer->endElement();
    }

    /**
     * @param array $attributes
     * @return Tag
     */
    public function setAttributes($attributes): Tag
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param string $key
     * @return Tag
     */
    public function setKey($key): Tag
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param BaseObject|string $value
     * @return Tag
     */
    public function setValue($value): Tag
    {
        $this->value = $value;
        return $this;
    }
}