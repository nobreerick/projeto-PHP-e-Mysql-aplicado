<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testData = [
    'nome'=>'fulano fobre',
    'email'=>'fulaninhofobrinho@gmail.com',
    'senha'=>'Senha@2025',
    'data_criacao'=>date('Y-m-d H:i:s'),
    'data_modificacao'=>date('Y-m-d H:i:s'),
    'ativo'=> true
];

$userDao = new UsersDao;

$success = $userDao->validateUserEmail($testData);

if (!$success){
    echo "0\n";
    return false;
}

echo "1\n";
return true;
