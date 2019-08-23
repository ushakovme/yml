[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iamsaint/yml/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/iamsaint/yml/?branch=master) [![Code Intelligence Status](https://scrutinizer-ci.com/g/iamsaint/yml/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence) [![Build Status](https://scrutinizer-ci.com/g/iamsaint/yml/badges/build.png?b=master)](https://scrutinizer-ci.com/g/iamsaint/yml/build-status/master) [![Latest Stable Version](https://poser.pugx.org/iamsaint/yml/v/stable)](https://packagist.org/packages/iamsaint/yml) [![Total Downloads](https://poser.pugx.org/iamsaint/yml/downloads)](https://packagist.org/packages/iamsaint/yml)  [![License](https://poser.pugx.org/iamsaint/yml/license)](https://packagist.org/packages/iamsaint/yml) [![Monthly Downloads](https://poser.pugx.org/iamsaint/yml/d/monthly)](https://packagist.org/packages/iamsaint/yml)

Installation
-------------
```
composer require iamsaint/yml
```

After that, make sure your application autoloads Composer classes by including
`vendor/autoload.php`.

How to use it
-------------

```php

use iamsaint\yml\Writer;
use iamsaint\yml\components\{
    Shop,
    Currency,
    Category
}

// create shop
$shop = new Shop();
$shop->setName('Shop Name')
    ->setUrl('http://...')
    ->setCompany('My Company');

// create currency
$currency = new Currency();
$currency
    ->setId(Currency::RUR)
    ->setRate(Currency::DEFAULT_RATE);

// add currency
$shop->addCurrency($currency);

// create category
$category = new Category();
$category
    ->setId(1)
    ->setName("My category");

// create subcategory
$subCategory = new Category();
$subCategory
    ->setId(2)
    ->setParentId(1)
    ->setName("My subcategory");

// add categories to shop
$shop->addCategory($category);
$shop->addCategory($subCategory);

// create offer
$offer = new Offer();

$offer->setId(123)
    ->setUrl('http://...')
    ->setPrice(1000)
    ->setCurrencyId(Currency::RUR);

// add offer to shop    
$shop->addOffer($offer);

// create writer
$writer = new Writer();

// write to file
$writer->write('path/to/file.yml', $shop);

```
