<?php

namespace iamsaint\yml;

use DateTime;
use iamsaint\yml\components\Shop;
use XMLWriter;

class Writer extends BaseObject
{
    /**
     * @var Shop $shop
     */
    public $shop;

    /**
     * @param string $fileName
     * @return bool|int
     * @throws \Exception
     */
    public function write(string $fileName)
    {
        return file_put_contents($fileName, $this->writeToString());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function writeToString(): string
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->startElement('yml_catalog');
        $writer->writeAttribute('date', (new DateTime('now'))->format('Y-m-d H:i'));

        if ($this->shop !== null) {
            $this->shop->setWriter($writer)->write();
        }

        $writer->endElement();
        return $writer->flush();
    }

    /**
     * @param Shop $shop
     */
    public function addShop(Shop $shop): void
    {
        $this->shop = $shop;
    }

}