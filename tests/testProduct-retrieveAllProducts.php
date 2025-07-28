<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\Product;

$productsArray = Product::retrieveAllProducts();

var_dump($productsArray);

if (!$productsArray) {
    echo "0\n";
}

echo "1\n";