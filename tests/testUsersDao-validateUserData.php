<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testData = [
    'nome'=>'fulano fobre',
    'email'=>'fulaninhofobrinho@gmail.com',
    'senha'=>'Senha@2025'
];

$testUserDao = new UsersDao();

$success = $testUserDao->validateUserData($testData);

if (!$success) {
    echo '0' . "\n";
    exit;
}

echo '1' . "\n";

