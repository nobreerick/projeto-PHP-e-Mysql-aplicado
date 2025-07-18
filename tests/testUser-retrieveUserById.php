<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\User;

$id = 5;

$user = User::retrieveUserById($id);

var_dump($user);

if (!$user) {
    echo "0\n";
}

echo "1\n";
