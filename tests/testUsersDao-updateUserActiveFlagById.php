<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$testUserDao = new UsersDao();

$id = 2;

$success = $testUserDao->updateUserActiveFlagById($id);

if (!$success) {
    echo '0' . "\n";
    exit;
}

echo '1' . "\n";
