<?php

namespace Nobreerick\MyphpsqlWeb\domain\models;
use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

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
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreationDate(): string
    {
        return $this->dataCriacao;
    }

    public function getModifyDate(): string
    {
        return $this->dataModificacao;
    }

    public function getIsActive(): bool
    {
        return $this->ativo;
    }

    public function getUserArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'data_criacao' => $this->dataCriacao,
            'data_modificacao' => $this->dataModificacao,
            'ativo' => $this->ativo
        ];
    }

    public static function retrieveUserById(int $id): ?User
    {
        $usersDao = new UsersDao();
        $userData = $usersDao->readUserById($id);
        
        if ($userData) {
            return new User($userData);
        }
        /*
        2. new User($userData): Cria uma nova instância da classe User, passando os dados do usuário como argumento para o construtor.
        */
        return null;
    }
    
    public static function retrieveAllUsers(): ?array
    {
        $usersDao = new UsersDao();
        $usersData = $usersDao->readAllUsers();
        
        if ($usersData) {
            return array_map(fn($item) => new User($item), $usersData);
        }
        /*
        2. array_map(): Aplica uma função a cada elemento do array $usersData e retorna um novo array com os resultados.
        3. fn($item) => new User($item): É uma arrow function (função anônima) que recebe cada $item (um array associativo) e cria uma nova instância da classe Product, passando $item como argumento para o construtor.
        */
        return null;
    }



}

