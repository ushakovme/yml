<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use function count;

/**
 * Class Offer
 * @package iamsaint\yml\components
 *
 * @property int $id
 * @property string $type
 * @property bool $available
 * @property string $url
 * @property float $price
 * @property int $currencyId
 * @property int $categoryId
 * @property bool $store
 * @property bool $delivery
 * @property string $name
 * @property array $deliveryOptions
 * @property string $typePrefix
 * @property string $vendor
 * @property string $vendorCode
 * @property string $model
 * @property string $description
 * @property string $salesNotes
 * @property string $barcode
 * @property int $age
 * @property array $pictures
 * @property bool $manufacturerWarranty
 * @property array $countryOfOrigin
 * @property OfferParam[] $params
 * @property bool $adult
 * @property array $customTags
 */
class Offer extends BaseObject
{
    public $id;
    public $type;
    public $available = true;
    public $url;
    public $price;
    public $currencyId;
    public $categoryId;
    public $store = true;
    public $delivery = false;
    public $name;
    public $deliveryOptions;
    public $typePrefix;
    public $vendor;
    public $vendorCode;
    public $model;
    public $description;
    public $salesNotes;
    public $barcode;
    public $age = 0;
    public $pictures = [];
    public $manufacturerWarranty = true;
    public $countryOfOrigin;
    public $params;
    public $adult = false;
    public $customTags = [];

    public function write(): void
    {
        $this->writer->startElement('offer');
        $this->writer->writeAttribute('id', $this->id);
        if ($this->type !== null) {
            $this->writer->writeAttribute('type', $this->type);
        }
        $this->writer->writeAttribute('available', $this->available ? 'true' : 'false');

        if ($this->url !== null) {
            $this->writer->writeElement('url', $this->url);
        }
        if ($this->price !== null) {
            $this->writer->writeElement('price', $this->price);
        }
        if ($this->currencyId !== null) {
            $this->writer->writeElement('currencyId', $this->currencyId);
        }
        if ($this->categoryId !== null) {
            $this->writer->writeElement('categoryId', $this->categoryId);
        }

        if (count($this->pictures) > 0) {
            foreach ($this->pictures as $picture) {
                $picture->setWriter($this->writer)->write();
            }
        }

        if ($this->store) {
            $this->writer->writeElement('store', $this->store ? 'true' : 'false');
        }
        if ($this->delivery) {
            $this->writer->writeElement('delivery', $this->delivery ? 'true' : 'false');
        }
        if ($this->name !== null) {
            $this->writer->writeElement('name', $this->name);
        }
        if ($this->vendor !== null) {
            $this->writer->writeElement('vendor', $this->vendor);
        }
        if ($this->vendorCode !== null) {
            $this->writer->writeElement('vendorCode', $this->vendorCode);
        }
        if ($this->model !== null) {
            $this->writer->writeElement('model', $this->model);
        }
        if ($this->description !== null) {
            $this->writer->writeElement('description', $this->description);
        }
        if ($this->salesNotes !== null) {
            $this->writer->writeElement('sales_notes', $this->salesNotes);
        }
        if ($this->barcode !== null) {
            $this->writer->writeElement('barcode', $this->barcode);
        }
        if ($this->age !== null) {
            $this->writer->writeElement('age', $this->age);
        }
        if ($this->manufacturerWarranty) {
            $this->writer->writeElement('manufacturer_warranty', $this->manufacturerWarranty ? 'true' : 'false');
        }

        $this->writeCustomTags();

        if (count($this->params) > 0) {
            foreach ($this->params as $param) {
                $param->setWriter($this->writer)->write();
            }
        }

        $this->writer->endElement();
    }

    public function writeCustomTags()
    {
        foreach ($this->customTags as $key => $value) {
            $this->writer->writeElement($key, $value);
        }
    }

    /**
     * @param OfferParam $param
     * @return bool
     */
    public function addParam(OfferParam $param): ?bool
    {
        if ($param->validate()) {
            $this->params[] = $param;
            return true;
        }

        $this->errors['params'][] = $param->errors;
        return false;
    }

    /**
     * @param OfferPicture $picture
     * @return bool
     */
    public function addPicture(OfferPicture $picture): ?bool
    {
        if ($picture->validate()) {
            $this->pictures[] = $picture;
            return true;
        }

        $this->errors['pictures'][] = $picture->errors;
        return false;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $type
     * @return Offer
     */
    public function setType(string $type): Offer
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $available
     * @return Offer
     */
    public function setAvailable(bool $available = true): Offer
    {
        $this->available = $available;
        return $this;
    }

    /**
     * @param mixed $price
     * @return Offer
     */
    public function setPrice($price): Offer
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param mixed $currencyId
     * @return Offer
     */
    public function setCurrencyId($currencyId): Offer
    {
        $this->currencyId = $currencyId;
        return $this;
    }

    /**
     * @param mixed $id
     * @return Offer
     */
    public function setId($id): Offer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $categoryId
     * @return Offer
     */
    public function setCategoryId($categoryId): Offer
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @param bool $delivery
     * @return Offer
     */
    public function setDelivery(bool $delivery): Offer
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @param mixed $deliveryOptions
     * @return Offer
     */
    public function setDeliveryOptions($deliveryOptions): Offer
    {
        $this->deliveryOptions = $deliveryOptions;
        return $this;
    }

    /**
     * @param mixed $typePrefix
     * @return Offer
     */
    public function setTypePrefix($typePrefix): Offer
    {
        $this->typePrefix = $typePrefix;
        return $this;
    }

    /**
     * @param mixed $vendor
     * @return Offer
     */
    public function setVendor($vendor): Offer
    {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * @param mixed $vendorCode
     * @return Offer
     */
    public function setVendorCode($vendorCode): Offer
    {
        $this->vendorCode = $vendorCode;
        return $this;
    }

    /**
     * @param mixed $model
     * @return Offer
     */
    public function setModel($model): Offer
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param mixed $description
     * @return Offer
     */
    public function setDescription($description): Offer
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param bool $manufacturerWarranty
     * @return Offer
     */
    public function setManufacturerWarranty(bool $manufacturerWarranty): Offer
    {
        $this->manufacturerWarranty = $manufacturerWarranty;
        return $this;
    }

    /**
     * @param mixed $countryOfOrigin
     * @return Offer
     */
    public function setCountryOfOrigin($countryOfOrigin): Offer
    {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }

    /**
     * @param mixed $params
     * @return Offer
     */
    public function setParams($params): Offer
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param mixed $params
     * @return Offer
     */
    public function setName($name): Offer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param bool $adult
     * @return Offer
     */
    public function setAdult(bool $adult): Offer
    {
        $this->adult = $adult;
        return $this;
    }
}