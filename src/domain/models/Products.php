<?php

namespace Nobreerick\MyphpsqlWeb\Domain\Models;

require_once __DIR__ . '/../../../vendor/autoload.php';

class Products
{
    private array $productData = [
        'id' => null, 
        'tipo' => null,
        'nome' => null,
        'descricao' => null,
        'imagem' => null,
        'preco' => 0
    ];

    public function __construct(int $id, string $tipo, string $nome, string $descricao, string $imagem, float $preco)
    {
        $this->productData['id'] = $id;
        $this->productData['tipo'] = $tipo;
        $this->productData['nome'] = $nome;
        $this->productData['descricao'] = $descricao;
        $this->productData['imagem'] = $imagem;
        $this->productData['preco'] = $preco;
    }

    public function extractAtribute(array $productData, int $index): string 
    {
        $atribute = array_keys($productData);
        if (!isset($atribute[$index])) {
            throw new \InvalidArgumentException("Índice não está entre 0 e 4, portanto é inválido: $index");
        }
        return $atribute[$index]; 
    }
}