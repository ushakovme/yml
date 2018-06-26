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

    public function write()
    {
        $this->writer->startElement('currency');

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
            static::DEFAULT_RATE,
        ];
    }

    public function rules() {
        return [
            [['id', 'rate'], 'required'],
            ['id', 'one_of', static::getSignList()],
            ['rate', 'one_of', static::getRateList()],
        ];
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
        $this->rate = $rate;
        return $this;
    }
}