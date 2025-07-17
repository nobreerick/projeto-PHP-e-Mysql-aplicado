<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testData = [
    'nome'=>'Kobra Kevin',
    'email'=>'kobra.kevin@gmail.com',
    'senha'=>'Abcd1234@',
    'data_criacao' => date('Y-m-d H:i:s'),
    'data_modificacao' => date('Y-m-d H:i:s'),
    'ativo' => true
];

$testeProductDao = new UsersDao();

echo $testeProductDao->createUser($testData) . "\n";