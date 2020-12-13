<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use XMLWriter;

/**
 * Class OfferParam
 * @package iamsaint\yml\components
 *
 * @property string $name
 * @property string $text
 * @property string $unit
 * @property Tag[] $customTags
 */
class OfferParam extends BaseObject
{
    public $name;
    public $text;
    public $unit;
    public $customTags = [];

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
        $writer->startElement('param');

        if (null !== $this->name) {
            $writer->writeAttribute('name', $this->name);
        }
        if (null !== $this->unit) {
            $writer->writeAttribute('unit', $this->unit);
        }
        if (null !== $this->text) {
            $writer->text($this->text);
        }

        $this->writeCustomTags($writer);

        $writer->endElement();
    }

    /**
     * @param XMLWriter $writer
     */
    public function writeCustomTags($writer): void
    {
        foreach ($this->customTags as $tag) {
            $tag->write($writer);
        }
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}
