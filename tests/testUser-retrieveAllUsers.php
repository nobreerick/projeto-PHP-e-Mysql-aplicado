<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\User;

$users = User::retrieveAllUsers();

var_dump($users);

if (!$user) {
    echo "0\n";
}

echo "1\n";
