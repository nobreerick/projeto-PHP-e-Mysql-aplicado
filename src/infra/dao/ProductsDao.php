<?php 
 
namespace Nobreerick\MyphpsqlWeb\infra\dao;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\ConnectionMaker;
use Nobreerick\MyphpsqlWeb\Domain\Models\Products;
use InvalidArgumentException;
use PDOException;
use PDO;

class ProductsDao
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

    public function createProduct(array $data): bool
    {
        $this->validateData($data);
        
        $statement = $this->cursor?->isConnected()->prepare(
            'INSERT INTO produtos (tipo, nome, descricao, imagem, preco) VALUES (:tipo, :nome, :descricao, :imagem, :preco)'
        );
        $statement->bindValue(':tipo', $data['tipo']);
        $statement->bindValue(':nome', $data['nome']);
        $statement->bindValue(':descricao', $data['descricao']);
        $statement->bindValue(':imagem', $data['imagem']);
        $statement->bindValue(':preco', $data['preco']);
        $success = $statement->execute();
        if (!$success) {
            throw new PDOException("Erro ao inserir o produto: " . implode(", ", $statement->errorInfo()));
        }

        return $success;
    }

    /*public function readProductById(int $id): ?array
    {
        $statement = 'SELECT * FROM products WHERE id = :id';
        foreach ($this->cursor?->isConnected()->query($statement) as $row) {
            
    }*/
    
    public function updateProduct(string $atribute, array $data): bool
    {
        $this->validateData($data);

        $statement = $this->cursor?->isConnected()->prepare(
            'UPDATE 
            produtos 
            SET 
            tipo = :tipo, 
            nome = :nome, 
            descricao = :descricao, 
            imagem = :imagem, 
            preco = :preco 
            WHERE 
            '. $atribute . ' = :atribute'
        );
        $statement->bindValue(':atribute', $data[$atribute]);
        $statement->bindValue(':tipo', $data['tipo']);
        $statement->bindValue(':nome', $data['nome']);
        $statement->bindValue(':descricao', $data['descricao']);
        $statement->bindValue(':imagem', $data['imagem']);
        $statement->bindValue(':preco', $data['preco']);
        $success = $statement->execute();
        if (!$success) {
            throw new PDOException("Erro ao atualizar o produto: " . implode(", ", $statement->errorInfo()));
        }
        return $success;
        
    }
    
    public function deleteProductById(int $id): bool
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'DELETE FROM produtos WHERE id = :id'
        );
        $statement->bindValue(':id', $id);
        $success = $statement->execute();
        if (!$success) {
            throw new PDOException("Erro ao excluir o produto: " . implode(", ", $statement->errorInfo()));
        }

        return $success;
    }

    public function validateData(array $data): bool
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                throw new InvalidArgumentException("O campo '$key' não pode estar vazio.");
            }  
        }
        if (!is_numeric($data['preco']) || $data['preco'] <= 0) {
            throw new InvalidArgumentException("O campo 'preço' deve ser um número positivo.");
        }
        return true;
    }
}