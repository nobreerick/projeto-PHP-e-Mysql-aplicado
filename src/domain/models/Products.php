<?php

namespace Nobreerick\MyphpsqlWeb\Domain\Models;

require_once __DIR__ . '/../../../vendor/autoload.php';

class Products
{
    private array $data = [
        'id' => null, 
        'tipo' => null,
        'nome' => null,
        'descricao' => null,
        'imagem' => null,
        'preco' => 0
    ];

    public function __construct(int $id, string $tipo, string $nome, string $descricao, string $imagem, float $preco)
    {
        $this->data['id'] = $id;
        $this->data['tipo'] = $tipo;
        $this->data['nome'] = $nome;
        $this->data['descricao'] = $descricao;
        $this->data['imagem'] = $imagem;
        $this->data['preco'] = $preco;
    }

    public function extractAtribute(array $data, int $index): string 
    {
        $atribute = array_keys($data);
        if (!isset($atribute[$index])) {
            throw new \InvalidArgumentException("Índice não está entre 0 e 4, portanto é inválido: $index");
        }
        return $atribute[$index]; 
    }
}