<?php

namespace iamsaint\yml\components;

use iamsaint\yml\exceptions\IncorrectCurrencyRateException;
use iamsaint\yml\exceptions\IncorrectCurrencySignException;
use iamsaint\yml\BaseObject;

/**
 * Class Currency
 * @package iamsaint\yml\components
 *
 * @property int $id
 * @property float $rate
 * @property array $customTags
 */
class Currency extends BaseObject
{
    public $id;
    public $rate;
    public $customTags = [];

    public const CBRF = 'CBRF';
    public const NBU = 'NBU';
    public const NBK = 'NBK';
    public const CB = 'CB';
    public const DEFAULT_RATE = '1';

    public const RUR = 'RUR';
    public const BYN = 'BYN';
    public const UAH = 'UAH';
    public const KZT = 'KZT';

    public function write(): void
    {
        $this->writer->startElement('currency');

        $this->writer->writeAttribute('id', $this->id);
        $this->writer->writeAttribute('rate', $this->rate);

        $this->writeCustomTags();

        $this->writer->endElement();
    }

    public function writeCustomTags()
    {
        foreach ($this->customTags as $key => $value) {
            $this->writer->writeElement($key, $value);
        }
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