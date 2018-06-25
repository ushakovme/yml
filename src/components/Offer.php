<?php

namespace iamsaint\yml\components;

use iamsaint\yml\Object;
use XMLWriter;

class Offer extends Object
{
    public $id;
    public $type = 'vendor.model';
    public $available = true;
    public $url;
    public $price;
    public $currencyId;
    public $categoryId;
    public $delivery = true;
    public $deliveryOptions;
    public $typePrefix;
    public $vendor;
    public $vendorCode;
    public $model;
    public $description;
    public $manufacturerWarranty = true;
    public $countryOfOrigin;
    public $params;
    public $adult = false;

    /**
     * @throws \iamsaint\yml\exceptions\IncorrectCurrencySignException
     * @throws \iamsaint\yml\exceptions\IncorrectCurrencyRateException
     */
    public function write()
    {
        $this->writer->startElement('offer');

        if (null !== $this->id) {
            $this->writer->writeAttribute('id', $this->id);
        }
        if (null !== $this->type) {
            $this->writer->writeAttribute('type', $this->type);
        }

        $this->writer->writeAttribute('available', $this->available ? 'true' : 'false');

        if (null !== $this->url) {
            $this->writer->writeElement('url', $this->url);
        }
        if (null !== $this->price) {
            Currency::validateRate($this->price);
            $this->writer->writeElement('price', $this->price);
        }
        if (null !== $this->currencyId) {
            Currency::validateId($this->categoryId);
            $this->writer->writeElement('currencyId', $this->currencyId);
        }
        if (null !== $this->delivery) {
            $this->writer->writeAttribute('delivery', $this->delivery);
        }
        if (null !== $this->deliveryOptions) {
            $this->writer->writeAttribute('delivery-options', $this->deliveryOptions);
        }
        if (null !== $this->typePrefix) {
            $this->writer->writeAttribute('typePrefix', $this->typePrefix);
        }
        if (null !== $this->vendor) {
            $this->writer->writeAttribute('vendor', $this->vendor);
        }
        if (null !== $this->vendorCode) {
            $this->writer->writeAttribute('vendorCode', $this->vendorCode);
        }
        if (null !== $this->model) {
            $this->writer->writeAttribute('model', $this->model);
        }
        if (null !== $this->description) {
            $this->writer->writeAttribute('description', $this->description);
        }
        if (null !== $this->manufacturerWarranty) {
            $this->writer->writeAttribute('manufacturer_warranty', $this->manufacturerWarranty);
        }
        if (null !== $this->countryOfOrigin) {
            $this->writer->writeAttribute('country_of_origin', $this->countryOfOrigin);
        }
        if ($this->adult) {
            $this->writer->writeAttribute('adult', 'true');
        }
        if (count($this->params) > 0) {
            foreach ($this->params as $param) {
                $param->write();
            }
        }
        $this->writer->endElement();
    }

    /**
     * @param string $name
     * @param string $text
     * @param string|null $unit
     */
    public function addParam(string $name, string $text, string $unit = null)
    {
        $param = new OfferParam($this->writer);
        $param->name = $name;
        $param->text = $text;
        if (null !== $unit) {
            $param->unit = $unit;
        }
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $type
     * @return Offer
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $available
     * @return Offer
     */
    public function setAvailable(bool $available = true)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * @param mixed $price
     * @return Offer
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param mixed $currencyId
     * @return Offer
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;
        return $this;
    }

    /**
     * @param mixed $id
     * @return Offer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $categoryId
     * @return Offer
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @param bool $delivery
     * @return Offer
     */
    public function setDelivery(bool $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @param mixed $deliveryOptions
     * @return Offer
     */
    public function setDeliveryOptions($deliveryOptions)
    {
        $this->deliveryOptions = $deliveryOptions;
        return $this;
    }

    /**
     * @param mixed $typePrefix
     * @return Offer
     */
    public function setTypePrefix($typePrefix)
    {
        $this->typePrefix = $typePrefix;
        return $this;
    }

    /**
     * @param mixed $vendor
     * @return Offer
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * @param mixed $vendorCode
     * @return Offer
     */
    public function setVendorCode($vendorCode)
    {
        $this->vendorCode = $vendorCode;
        return $this;
    }

    /**
     * @param mixed $model
     * @return Offer
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param mixed $description
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param bool $manufacturerWarranty
     * @return Offer
     */
    public function setManufacturerWarranty(bool $manufacturerWarranty)
    {
        $this->manufacturerWarranty = $manufacturerWarranty;
        return $this;
    }

    /**
     * @param mixed $countryOfOrigin
     * @return Offer
     */
    public function setCountryOfOrigin($countryOfOrigin)
    {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }

    /**
     * @param mixed $params
     * @return Offer
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param bool $adult
     * @return Offer
     */
    public function setAdult(bool $adult)
    {
        $this->adult = $adult;
        return $this;
    }
}