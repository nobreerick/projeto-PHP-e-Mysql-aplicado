<?php

namespace Nobreerick\MyphpsqlWeb\Domain\Models;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

class Product
{
    private ?int $id; 
    private string $tipo; 
    private string $nome; 
    private string $descricao; 
    private string $imagem; 
    private float $preco;

    public function __construct(array $dados)
    {
        $this->id = $dados['id'] ?? 0;
        $this->tipo = $dados['tipo'] ?? '';
        $this->nome = $dados['nome'] ?? '';
        $this->descricao = $dados['descricao'] ?? '';
        $this->imagem = $dados['imagem'] ?? '';
        $this->preco = $dados['preco'] ?? 0.0;
    }

    public function getProductArray(): array
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'imagem' => $this->imagem,
            'preco' => $this->preco
        ];
    }

    public static function retrieveProductById(int $id): ?Product
    {
        $productsDao = new ProductsDao();
        $productData = $productsDao->readProductById($id);
        
        if ($productData) {
            return new Product($productData);
        }
        
        return null;
    }
    
    public static function retrieveArrayProducts(string $atribute, array $data): ?array
    {
        $productsDao = new ProductsDao();
        $productsData = $productsDao->readArrayProducts($atribute, $data);
        
        if ($productsData) {
            return array_map(fn($item) => new Product($item), $productsData);
        }
        /*
        2. array_map(): Aplica uma função a cada elemento do array $productsData e retorna um novo array com os resultados.
        3. fn($item) => new Product($item): É uma arrow function (função anônima) que recebe cada $item (um array associativo) e cria uma nova instância da classe Product, passando $item como argumento para o construtor.
        */
        return null;
    }

    public static function retrieveAllProducts(): ?array
    {
        $productsDao = new ProductsDao();
        $productsData = $productsDao->readAllProducts();
        
        if ($productsData) {
            return array_map(fn($item) => new Product($item), $productsData);
        }
        /*
        2. array_map(): Aplica uma função a cada elemento do array $productsData e retorna um novo array com os resultados.
        3. fn($item) => new Product($item): É uma arrow function (função anônima) que recebe cada $item (um array associativo) e cria uma nova instância da classe Product, passando $item como argumento para o construtor.
        */
        return null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->tipo;
    }

    public function getName(): string
    {
        return $this->nome;
    }

    public function getDescription(): string
    {
        return $this->descricao;
    }
    
    public function getImage(): string
    {
        return $this->imagem;
    }

    public function getPrice(): float
    {
        return $this->preco;
    }

    public function getImageWithDirectory(string $directory): string
    {
        return $directory . $this->imagem;
    }

    public function getFormattedPrice(): string
    {
        return "R$ " . number_format($this->preco, 2, ',', '.');
    }
}