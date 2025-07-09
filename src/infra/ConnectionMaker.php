<?php

namespace Nobreerick\MyphpsqlWeb\infra;

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;        

class ConnectionMaker
{
    private $connected = null;
    
    public function __construct()
    {
        $this->connected = $this->createConnection();
    }
    
    private function createConnection(): PDO
    {
        $driverConfig = $this->gerarDBConfig();
        $pdo = new PDO($driverConfig);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    
    private function gerarDBConfig(): string
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $usuario = $_ENV['USUARIO'];
        $password = $_ENV['PASSWORD'];
        $driver = $_ENV['DRIVER'];
        $host = $_ENV['HOST'];
        $dbName = $_ENV['DBNAME'];

        return "$driver:host=$host;dbname=$dbName;user=$usuario;password=$password";
    }

    public function isConnected(): PDO
    {
        return $this->connected;
    }

    public function disconnect(): void
    {
        $this->connected = null;
    }
}

