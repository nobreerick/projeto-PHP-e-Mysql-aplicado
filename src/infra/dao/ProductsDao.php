<?php 
 
namespace Nobreerick\MyphpsqlWeb\infra\dao;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\ConnectionMaker;
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
        try {
            $this->validateData($data);
        }

        catch (InvalidArgumentException $e) {
            echo "Erro de validação: " . $e->getMessage();
        }
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

    public function readProductById(int $id): ?array
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT 
            * 
            FROM 
            produtos 
            WHERE 
            id = :id'
        );

        $statement->bindValue(':id', $id);

        $statement->execute();

        $response = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $response ?: null;
    }
    
    public function readArrayProducts(string $atribute, array $data): ?array
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT 
            * 
            FROM 
            produtos 
            WHERE ' . $atribute . ' = :atribute'
        );

        $statement->bindValue(':atribute', $data[$atribute]);

        $statement->execute();

        $response = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $response ?: null;
    }

    public function readAllProducts(): ?array
    {
        $statement = $this->cursor?->isConnected()->prepare(
            'SELECT 
            * 
            FROM 
            produtos'
        );

        $statement->execute();

        $response = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $response ?: null;
    }
    
    public function updateProduct(string $atribute, array $data): bool
    {
        var_dump($data);
        echo "validando dados... \n";
        $this->validateData($data);
        echo "dados validados com sucesso! \n";


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
        echo "entrou na validação dos dados... \n";
        foreach ($data as $key => $value) {
            echo "Validando o campo '$key' com o valor '$value'... \n";
            if ($key === 'id' && $value === "0") {
                continue; // O campo 'id' pode ser 0 ou um número positivo
            }
            if (empty($value)) {
                throw new InvalidArgumentException("O campo '$key' não pode estar vazio.");
                echo "Erro: O campo '$key' não pode estar vazio.";
            }  
        }
        if (!is_numeric($data['preco']) || $data['preco'] <= 0) {
            throw new InvalidArgumentException("O campo 'preço' deve ser um número positivo.");
            echo "Erro: O campo 'preço' deve ser um número positivo.";
        }
        return true;
    }
}