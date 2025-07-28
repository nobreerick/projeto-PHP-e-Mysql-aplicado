<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$testData = [
    'id' => 1, // ID do produto a ser atualizado
    'tipo' => 'Café',
    'nome' => 'Café Gelado',
    'descricao' => 'Café gelado refrescante, adoçado e com notas sutis de baunilha ou caramelo.',
    'imagem' => 'img/cafe-gelado.jpg',
    'preco' => 1113.00
];

$testeProductDao = new ProductsDao();

$atribute = array_keys($testData);

$response = $testeProductDao->readArrayProducts($atribute[1], $testData);

if (!$response) {
    echo "0\n";
}

echo "1\n";
