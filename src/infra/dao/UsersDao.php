<?php

namespace Nobreerick\MyphpsqlWeb\infra\dao;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\ConnectionMaker;
use InvalidArgumentException;
use PDOException;
use PDO;
use DateTime;

class UsersDao
{
    private $cursor = null;

    function __construct()
    {
        $this->cursor = new ConnectionMaker();
    }

    function __destruct()
    {
        $this->cursor->disconnect();
    }

    public function createUser(array $data): bool
    {
        try {
            $this->validateUserData($data);
        }
        catch (InvalidArgumentException $e) {
            echo "Erro de validação: " . $e->getMessage();
            exit;
        }

        $passwordHash = hash('sha256', $data['senha']);
        
        $statement = $this->cursor?->isConnected()->prepare(
            'INSERT INTO usuarios (nome, email, senha, data_criacao, data_modificacao) VALUES (:nome, :email, :senha, :data_criacao, :data_modificacao)'
        );
        $statement->bindValue(':nome', $data['nome']);
        $statement->bindValue(':email', $data['email']);
        $statement->bindValue(':senha', $passwordHash);
        $statement->bindValue(':data_criacao', date('Y-m-d H:i:s'));
        $statement->bindValue(':data_modificacao', date('Y-m-d H:i:s'));
        $success = $statement->execute();
        if (!$success) {
            throw new PDOException("Erro ao inserir o produto: " . implode(", ", $statement->errorInfo()));
        }
        return $success;
    }

    public function readUserById(int $id): ?array
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT 
            * 
            FROM 
            usuarios
            WHERE 
            id = :id'
        );

        $statement->bindValue(':id', $id);

        $statement->execute();

        $response = $statement->fetch(PDO::FETCH_ASSOC);

        return $response ?: null;
    }

    public function readAllUsers(): ?array
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT 
            * 
            FROM 
            usuarios'
        );

        $statement->execute();

        $response = $statement->fetchAll(PDO::FETCH_ASSOC);        
        
        return $response ?: null;
    }

    public function updateUser(int $id, array $data): bool
    {
        try {
            $this->validateUserData($data);
        } catch (InvalidArgumentException $e) {
            echo "Erro de validação: " . $e->getMessage();
            exit;
        }

        $passwordHash = hash('sha256', $data['senha']);

        $statement = $this->cursor?->isConnected()->prepare(
            'UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, data_modificacao = :data_modificacao WHERE id = :id'
        );
        $statement->bindValue(':nome', $data['nome']);
        $statement->bindValue(':email', $data['email']);
        $statement->bindValue(':senha', $passwordHash);
        $statement->bindValue(':data_modificacao', date('Y-m-d H:i:s'));
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $success = $statement->execute();
        if (!$success) {
            throw new PDOException("Erro ao atualizar o usuário: " . implode(", ", $statement->errorInfo()));
        }
        return $success;
    }

    public function deleteUserById(int $id): bool
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'DELETE FROM usuarios WHERE id = :id'
        );
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $success = $statement->execute();
        if (!$success) {
            throw new PDOException("Erro ao deletar o usuário: " . implode(", ", $statement->errorInfo()));
        }
        return $success;
    }

    public function validateUserData(array $data): bool
    {
        if (empty($data['email']) || empty($data['senha']) || empty($data['nome'])) {
            throw new InvalidArgumentException("Nome, email e senha são obrigatórios.");
            return false;
        }

        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (!preg_match($passwordRegex, $data['senha'])) {
            throw new InvalidArgumentException("A senha deve conter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e símbolos.");
            return false;
        }

        
        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        
        if (!preg_match($emailRegex, $data['email'])) {
            throw new InvalidArgumentException("O email deve ser válido.");
            return false;
        }

        return true;       
    }

    public function validateUserDatesData(array $data): bool
    {
        $creationDate = new DateTime($data['data_criacao']) ?? date('Y-m-d H:i:s');
        $modifyDate = new DateTime($data['data_modificacao'] ?? date('Y-m-d H:i:s'));
        $actualDate = new DateTime(date('Y-m-d H:i:s'));
        
        if ($actualDate < $creationDate || $actualDate < $modifyDate) {
            throw new InvalidArgumentException("A data de criação e modificação não podem ser futuras.");
            return false;
        }
        
        if (isset($data['data_criacao']) && !DateTime::createFromFormat('Y-m-d H:i:s', $data['data_criacao'])) {
            throw new InvalidArgumentException("A data de criação deve estar no formato 'Y-m-d H:i:s'.");
            return false;
        }

        if (isset($data['data_modificacao']) && !DateTime::createFromFormat('Y-m-d H:i:s', $data['data_modificacao'])) {
            throw new InvalidArgumentException("A data de modificação deve estar no formato 'Y-m-d H:i:s'.");
            return false;
        }

        return true;
    }

    public function validateUserIsActive(array $data): bool
    {
        $passwordHash = hash('sha256', $data['senha']);
        $email = $data['email'];
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT ativo FROM usuarios WHERE senha = :senha AND email = :email'
        );
        $statement->bindValue(':senha', $passwordHash);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $ativo = $statement->fetchColumn();

        if ($ativo == false) {
            throw new InvalidArgumentException("Usuário inativo.");
            return false;
        }
        return true;
    }

    public function validateAccess(array $data): bool
    {
        $passwordHash = hash('sha256', $data['senha']);
        $email = $data['email'];
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT COUNT(*) FROM usuarios WHERE senha = :senha AND email = :email'
        );
        $statement->bindValue(':senha', $passwordHash);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $count = $statement->fetchColumn();
        if ($count <= 0) {
            throw new InvalidArgumentException("Senha ou Email inválido.");
            return false;    
        }
        try {
            $this->validateUserIsActive($data);
        } catch (InvalidArgumentException $e) {
            echo "Erro de validação: " . $e->getMessage();
            return false;   
        }
        return true;
    }

    public function updateUserActiveFlagById(int $id): bool
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'UPDATE usuarios SET ativo = NOT ativo WHERE id = :id'
        );
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $success = $statement->execute();

        if (!$success) {
            throw new PDOException("Erro ao atualizar o status do usuário: " . implode(", ", $statement->errorInfo()));
        }

        return $success;
    }

}