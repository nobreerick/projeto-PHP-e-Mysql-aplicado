<?php

require_once __DIR__ . '/vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$userDao = new UsersDao();

$userDao->deleteUserById((int)$_POST['id']);

header("Location: admin.php");
