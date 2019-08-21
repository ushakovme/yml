<?php

namespace iamsaint\yml;

use DateTimeImmutable;
use Exception;
use XMLWriter;

/**
 * Class Writer
 * @package iamsaint\yml
 */
class Writer
{
    /**
     * @param string $fileName
     * @param BaseObject $object
     * @return bool|int
     * @throws Exception
     */
    public function write(string $fileName, BaseObject $object)
    {
        return file_put_contents($fileName, $this->writeToString($object));
    }

    /**
     * @param BaseObject $object
     * @return mixed
     * @throws Exception
     */
    private function writeToString($object): string
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->startElement('yml_catalog');
        $writer->writeAttribute('date', (new DateTimeImmutable('now'))->format('Y-m-d H:i'));

        if (null !== $object) {
            $object->write($writer);
        }

        $writer->endElement();
        return $writer->flush();
    }
}
