<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use iamsaint\yml\exceptions\IncorrectRuleException;
use XMLWriter;
use function count;

/**
 * Class Shop
 * @package iamsaint\yml\components
 *
 * @property string $name
 * @property string $company
 * @property string $url
 * @property Currency[] $currencies
 * @property Category[] $categories
 * @property array $deliveryOptions
 * @property Offer[] $offers
 * @property bool $adult
 * @property Tag[] $customTags
 */
class Shop extends BaseObject
{
    public $name;
    public $company;
    public $url;
    public $currencies = [];
    public $categories = [];
    public $deliveryOptions;
    public $offers = [];
    public $adult = false;
    public $customTags = [];

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
        $writer->startElement('shop');

        $tags = [
            ['name' => 'name', 'value' => $this->name, 'condition' => null],
            ['name' => 'company', 'value' => $this->company, 'condition' => null],
            ['name' => 'url', 'value' => $this->url, 'condition' => null],
            ['name' => 'adult', 'value' => $this->adult, 'condition' => false],
        ];

        foreach ($tags as $tag) {
            $this->writeTag($tag['name'], $tag['value'], $writer, $tag['condition']);
        }

        $this->writeCurrencies($writer);
        $this->writeCategories($writer);
        $this->writeOffers($writer);
        $this->writeCustomTags($writer);

        $writer->endElement();
    }

    /**
     * @param XMLWriter $writer
     */
    public function writeCurrencies($writer): void
    {
        if (count($this->currencies) > 0) {
            $this->writeElements($writer, 'currencies', $this->currencies);
        }
    }

    /**
     * @param XMLWriter $writer
     */
    public function writeCategories($writer): void
    {
        if (count($this->categories) > 0) {
            $this->writeElements($writer, 'categories', $this->categories);
        }
    }

    /**
     * @param XMLWriter $writer
     */
    public function writeOffers($writer): void
    {
        if (count($this->offers) > 0) {
            $this->writeElements($writer, 'offers', $this->offers);
        }
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
     * @param Category $category
     */
    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
    }

    /**
     * @param Currency $currency
     * @return bool
     * @throws IncorrectRuleException
     */
    public function addCurrency(Currency $currency): bool
    {
        if ($is_valid = $currency->validate()) {
            $this->currencies[] = $currency;
        } else {
            $this->errors['currency'][] = $currency->errors;
        }

        return $is_valid;
    }

    /**
     * @param Offer $offer
     */
    public function addOffer(Offer $offer): void
    {
        $this->offers[] = $offer;
    }

    /**
     * @param mixed $name
     * @return Shop
     */
    public function setName($name): Shop
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $company
     * @return Shop
     */
    public function setCompany($company): Shop
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @param mixed $url
     * @return Shop
     */
    public function setUrl($url): Shop
    {
        $this->url = $url;
        return $this;
    }
}
