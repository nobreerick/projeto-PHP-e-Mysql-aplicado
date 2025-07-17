<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testUserDao = new UsersDao();

$id = 2;

$testData = [
    'nome' => 'Fulano Fobre',
    'email' => 'fulaninhofobrinho@gmail.com',
    'senha' => 'SenhaForte123!'
];

echo $testUserDao->updateUser($id, $testData);
