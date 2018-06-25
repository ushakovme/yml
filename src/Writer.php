<?php

namespace iamsaint\yml;

use DateTime;
use iamsaint\yml\components\Shop;
use XMLWriter;

class Writer extends Object
{
    /**
     * @var Shop $shop
     */
    public $shop;

    /**
     * Writer constructor.
     */
    public function __construct(XMLWriter $writer = null)
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->startElement('yml_catalog');
        $writer->writeAttribute('date', (new DateTime('now'))->format('Y-m-d H:i'));

        parent::__construct($writer);
    }

    /**
     * @param string $fileName
     * @return bool|int
     */
    public function write(string $fileName)
    {
        return file_put_contents($fileName, $this->writeToSting());
    }

    /**
     * @return mixed
     */
    public function writeToString(): string
    {
        if (null !== $this->shop) {
            $this->shop->setWriter($this->writer)->write();
        }
        return $this->writer->flush();
    }

    public function addShop(Shop $shop) {
        $this->shop = $shop;
    }

}