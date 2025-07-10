<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$testData = [
    'id' => 9, // ID do produto a ser atualizado
    'tipo' => 'Eletrônico',
    'nome' => 'SmartphoneX',
    'descricao' => 'Smartphone de penúltima geração',
    'imagem' => 'smartphone-modified.jpg',
    'preco' => 999.99
];

$testeProductDao = new ProductsDao();

echo $testeProductDao->createProduct($testData) . "\n";

				