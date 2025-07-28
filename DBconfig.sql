-- 1. Criação do banco de dados
CREATE DATABASE IF NOT EXISTS serenatto;
USE serenatto;

-- 2. Criação da tabela produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100),
    nome VARCHAR(100),
    descricao TEXT,
    imagem VARCHAR(255),
    preco DECIMAL(10,2)
);

-- 3. Criação da tabela usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255),
    data_criacao TIMESTAMP,
    data_modificacao TIMESTAMP,
    ativo VARCHAR(1)
);

-- 4. Criação do usuário e concessão de privilégios (ajuste 'serenatto_user' e 'senha_segura' conforme necessário)
CREATE USER IF NOT EXISTS 'serenatto_user'@'localhost' IDENTIFIED BY 'senha_segura';
GRANT ALL PRIVILEGES ON serenatto.* TO 'serenatto_user'@'localhost';
FLUSH PRIVILEGES;