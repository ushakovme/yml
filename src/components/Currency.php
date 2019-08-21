<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use XMLWriter;

/**
 * Class Currency
 * @package iamsaint\yml\components
 *
 * @property int $id
 * @property float $rate
 * @property Tag[] $customTags
 */
class Currency extends BaseObject
{
    public const CBRF = 'CBRF';
    public const NBU = 'NBU';
    public const NBK = 'NBK';
    public const CB = 'CB';
    public const DEFAULT_RATE = '1';
    public const RUR = 'RUR';
    public const BYN = 'BYN';
    public const UAH = 'UAH';
    public const KZT = 'KZT';
    public $id;
    public $rate;
    public $customTags = [];

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
        $writer->startElement('currency');

        $writer->writeAttribute('id', $this->id);
        $writer->writeAttribute('rate', $this->rate);

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

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['id', 'rate'], 'required'],
            ['id', 'one_of', static::getSignList()],
            ['rate', 'one_of', static::getRateList()]
        ];
    }

    /**
     * @return array
     */
    public static function getSignList(): array
    {
        return [
            static::RUR,
            static::BYN,
            static::UAH,
            static::KZT
        ];
    }

    /**
     * @return array
     */
    public static function getRateList(): array
    {
        return [
            static::CBRF,
            static::NBU,
            static::NBK,
            static::CB,
            static::DEFAULT_RATE
        ];
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $rate
     * @return $this
     */
    public function setRate($rate): self
    {
        $this->rate = $rate;
        return $this;
    }
}
