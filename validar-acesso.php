<?php

require_once __DIR__ . '/vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$usersDao = new UsersDao();

if (isset($_POST['entrar'])) {

  $data = [
    "email" => $_POST['email'],
    "senha" => $_POST['password']
  ];
  
  $success = $usersDao->validateAccess($data);
  
  if (!$success) {
    header("Location: login.php");
    exit;
  }
  header("Location: admin.php");
  exit;
}
