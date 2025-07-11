<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$testData = [
    'id' => 4, // ID do produto a ser atualizado
    'tipo' => 'Café',
    'nome' => 'Café Cremoso',
    'descricao' => 'Café cremoso irresistivelmente suave e que envolve seu paladar',
    'imagem' => 'img/cafe-cremoso.jpg',
    'preco' => 5.50
];

$testeProductDao = new ProductsDao();

$atribute = array_keys($testData);

echo $testeProductDao->updateProduct($atribute[0], $testData) . "\n";