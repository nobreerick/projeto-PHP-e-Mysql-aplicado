<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\Product;

$testData = [
    'id' => 1, // ID do produto a ser atualizado
    'tipo' => 'Café',
    'nome' => 'Café Gelado',
    'descricao' => 'Café gelado refrescante, adoçado e com notas sutis de baunilha ou caramelo.',
    'imagem' => 'img/cafe-gelado.jpg',
    'preco' => 1113.00
];

$productsArray = Product::retrieveArrayProducts('tipo', $testData);



if (!$productsArray) {
    echo "0\n";
}

echo "1\n";
