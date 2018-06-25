<?php

namespace iamsaint\yml;

use XMLWriter;

class Object {
    /**
     * @var XMLWriter $writer
     */
    public $writer;

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
    public function setWriter(XMLWriter $writer) {
        $this->writer = $writer;
        return $this;
    }
}