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
use iamsaint\yml\components\Shop;
use iamsaint\yml\components\Offer;

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
    ->setName("My subategory");

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

// add shop to writer
$writer->addShop($shop);

// write to file
$writer->write('path/to/file.yml');

```
