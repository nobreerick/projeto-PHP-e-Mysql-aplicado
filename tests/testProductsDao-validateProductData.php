<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$testData = [
    'tipo' => 'Eletrônico',
    'nome' => 'Smartphone',
    'descricao' => 'Smartphone de última geração',
    'imagem' => 'smartphone.jpg',
    'preco' => 1999.99
];

$testeProductDao = new ProductsDao();

echo $testeProductDao->validateProductData($testData) . "\n";