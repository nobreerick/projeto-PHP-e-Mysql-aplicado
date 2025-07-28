<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$testeProductDao = new ProductsDao();

$response = $testeProductDao->readAllProducts();

var_dump($response);

if (!$response) {
    echo "0\n";
}

echo "1\n";