<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use iamsaint\yml\exceptions\IncorrectRuleException;
use XMLWriter;
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
 * @property Tag[] $customTags
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
    public $age = false;
    public $pictures = [];
    public $manufacturerWarranty = true;
    public $countryOfOrigin;
    public $params;
    public $adult = false;
    public $customTags = [];

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
        $writer->startElement('offer');
        $writer->writeAttribute('id', $this->id);
        if (null !== $this->type) {
            $writer->writeAttribute('type', $this->type);
        }
        $writer->writeAttribute('available', $this->available ? 'true' : 'false');

        if (null !== $this->url) {
            $writer->writeElement('url', $this->url);
        }
        if (null !== $this->price) {
            $writer->writeElement('price', $this->price);
        }
        if (null !== $this->currencyId) {
            $writer->writeElement('currencyId', $this->currencyId);
        }
        if (null !== $this->categoryId) {
            $writer->writeElement('categoryId', $this->categoryId);
        }

        if (count($this->pictures) > 0) {
            foreach ($this->pictures as $picture) {
                $picture->write($writer);
            }
        }

        if ($this->store) {
            $writer->writeElement('store', $this->store ? 'true' : 'false');
        }
        if (null !== $this->delivery) {
            $writer->writeElement('delivery', $this->delivery ? 'true' : 'false');
        }
        if (null !== $this->name) {
            $writer->writeElement('name', $this->name);
        }
        if (null !== $this->vendor) {
            $writer->writeElement('vendor', $this->vendor);
        }
        if (null !== $this->vendorCode) {
            $writer->writeElement('vendorCode', $this->vendorCode);
        }
        if (null !== $this->model) {
            $writer->writeElement('model', $this->model);
        }
        if (null !== $this->description) {
            $writer->writeElement('description', $this->description);
        }
        if (null !== $this->salesNotes) {
            $writer->writeElement('sales_notes', $this->salesNotes);
        }
        if (null !== $this->barcode) {
            $writer->writeElement('barcode', $this->barcode);
        }
        if (false !== $this->age) {
            $writer->writeElement('age', $this->age);
        }
        if ($this->manufacturerWarranty) {
            $writer->writeElement('manufacturer_warranty', $this->manufacturerWarranty ? 'true' : 'false');
        }

        $this->writeCustomTags($writer);

        if (count($this->params) > 0) {
            foreach ($this->params as $param) {
                $param->write($writer);
            }
        }

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
     * @param OfferParam $param
     * @return bool
     * @throws IncorrectRuleException
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
     * @throws IncorrectRuleException
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
     * @param $name
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
