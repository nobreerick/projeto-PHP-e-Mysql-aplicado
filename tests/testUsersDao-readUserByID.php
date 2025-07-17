<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$id = 2; 

$testeUsersDao = new UsersDao();

$response = $testeUsersDao->readUserById($id);

var_dump($response);

if (!$response) {
    echo "0\n";
}

echo "1\n";
