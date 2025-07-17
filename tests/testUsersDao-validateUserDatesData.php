<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testData = [
    'nome'=>'fulano fobre',
    'email'=>'fulaninhofobrinho@gmail.com',
    'senha'=>'Senha@2025',
    'data_criacao' => date('Y-m-d H:i:s'),
    'data_modificacao' => date('Y-m-d H:i:s'),
    'ativo' => true
];

$testUserDao = new UsersDao();

$success = $testUserDao->validateUserDatesData($testData);

if (!$success) {
    echo '0' . "\n";
    exit;
}

echo '1' . "\n";
