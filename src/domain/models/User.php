<?php

namespace Nobreerick\MyphpsqlWeb\domain\models;

require_once __DIR__ . '/../../../vendor/autoload.php';

class User 
{
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $dataCriacao;
    private string $dataModificacao;
    private bool $ativo;

    public function __construct(array $dados)
    {
        $this->id = $dados['id'] ?? null;
        $this->nome = $dados['nome'] ?? '';
        $this->email = $dados['email'] ?? '';
        $this->senha = $dados['senha'] ?? '';
        $this->dataCriacao = $dados['data_criacao'] ?? date('Y-m-d H:i:s');
        $this->dataModificacao = $dados['data_modificacao'] ?? date('Y-m-d H:i:s');
        $this->ativo = $dados['ativo'] ?? false;
    }

}

