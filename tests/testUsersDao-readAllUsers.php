<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testeUserDao = new UsersDao();

$response = $testeUserDao->readAllUsers();

var_dump($response);

if (!$response) {
    echo "0\n";
}

echo "1\n";