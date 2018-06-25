<?php

namespace iamsaint\yml\components;

use iamsaint\yml\exceptions\IncorrectCurrencyRateException;
use iamsaint\yml\exceptions\IncorrectCurrencySignException;
use iamsaint\yml\Object;

class Currency extends Object
{
    public $id;
    public $rate;

    const CBRF = 'CBRF';
    const NBU = 'NBU';
    const NBK = 'NBK';
    const CB = 'CB';
    const DEFAULT_RATE = '1';

    const RUR = 'RUR';
    const BYN = 'BYN';
    const UAH = 'UAH';
    const KZT = 'KZT';

    /**
     * @throws IncorrectCurrencyRateException
     * @throws IncorrectCurrencySignException
     */
    public function write()
    {
        $this->writer->startElement('currency');
        static::validateId($this->id);
        static::validateRate($this->rate);

        $this->writer->writeAttribute('id', $this->id);
        $this->writer->writeAttribute('rate', $this->rate);

        $this->writer->endElement();
    }

    public static function getSignList()
    {
        return [
            static::RUR,
            static::BYN,
            static::UAH,
            static::KZT,
        ];
    }

    public static function getRateList()
    {
        return [
            static::CBRF,
            static::NBU,
            static::NBK,
            static::CB,
        ];
    }

    /**
     * @throws IncorrectCurrencySignException
     */
    public static function validateId($id)
    {
        if (!in_array($id, static::getSignList())) {
            throw new IncorrectCurrencySignException();
        }
    }

    /**
     * @throws IncorrectCurrencyRateException
     */
    public static function validateRate($rate)
    {
        if (!in_array($rate, static::getSignList())) {
            if (!is_numeric($rate)) {
                throw new IncorrectCurrencyRateException();
            }
        }
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $rate
     * @return $this
     */
    public function setRate($rate) {
        $this->id = $rate;
        return $this;
    }
}