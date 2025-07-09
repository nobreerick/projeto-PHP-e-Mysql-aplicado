<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$id = 11;// ID do produto a ser deletado

$testeProductDao = new ProductsDao();

echo $testeProductDao->deleteProductById($id) . "\n";