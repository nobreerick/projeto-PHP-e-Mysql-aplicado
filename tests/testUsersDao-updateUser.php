<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testUserDao = new UsersDao();

$id = 5;

$testData = [
    'nome' => 'Kalel Jaime',
    'email' => 'kal.el.jaime@example.com',
    'senha' => 'SenhaForte123!'
];

echo $testUserDao->updateUser($id, $testData);
