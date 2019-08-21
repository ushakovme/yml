<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;

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

    public function write(): void
    {
        $this->writer->startElement('param');

        if (null !== $this->name) {
            $this->writer->writeAttribute('name', $this->name);
        }
        if (null !== $this->unit) {
            $this->writer->writeAttribute('unit', $this->unit);
        }
        if (null !== $this->text) {
            $this->writer->text($this->text);
        }

        $this->writeCustomTags();

        $this->writer->endElement();
    }

    public function writeCustomTags(): void
    {
        foreach ($this->customTags as $tag) {
            $tag->setWriter($this->writer)->write();
        }
    }
}