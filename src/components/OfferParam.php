<?php

namespace iamsaint\yml\components;

use iamsaint\yml\Object;

class OfferParam extends Object
{
    public $name;
    public $text;
    public $unit;

    public function write()
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

        $this->writer->endElement();
    }
}