<?php

namespace iamsaint\yml\components;

use iamsaint\yml\Object;

class Shop extends Object
{
    public $name;
    public $company;
    public $url;
    public $currencies = [];
    public $categories = [];
    public $deliveryOptions;
    public $offers = [];
    public $adult = false;

    public function write()
    {
        $this->writer->startElement('shop');
        if (null !== $this->name) {
            $this->writer->writeElement('name', $this->name);
        }
        if (null !== $this->company) {
            $this->writer->writeElement('company', $this->company);
        }
        if (null !== $this->url) {
            $this->writer->writeElement('url', $this->url);
        }

        if ($this->adult) {
            $this->writer->writeElement('adult', 'true');
        }

        if (count($this->currencies) > 0) {
            $this->writeElements('currencies', $this->currencies);
        }

        if (count($this->categories) > 0) {
            $this->writeElements('categories', $this->categories);
        }
        if (count($this->offers) > 0) {
            $this->writeElements('offers', $this->offers);
        }

        $this->writer->endElement();
    }

    public function addCategory(Category $category)
    {

        $this->categories[] = $category;
    }

    /**
     * @param Currency $currency
     */
    public function addCurrency(Currency $currency)
    {
        if($is_valid = $currency->validate()) {
            $this->currencies[] = $currency;
        } else {
            $this->errors['currency'][] = $currency->errors;
        }

        return $is_valid;
    }

    /**
     * @param Offer $offer
     */
    public function addOffer(Offer $offer)
    {
        $this->offers[] = $offer;
    }

    /**
     * @param mixed $name
     * @return Shop
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $company
     * @return Shop
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @param mixed $url
     * @return Shop
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

}