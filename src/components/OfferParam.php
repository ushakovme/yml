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
 */
class OfferParam extends BaseObject
{
    public $name;
    public $text;
    public $unit;

    public function write(): void
    {
        $this->writer->startElement('param');

        if ($this->name !== null) {
            $this->writer->writeAttribute('name', $this->name);
        }
        if ($this->unit !== null) {
            $this->writer->writeAttribute('unit', $this->unit);
        }
        if ($this->text !== null) {
            $this->writer->text($this->text);
        }

        $this->writer->endElement();
    }
}