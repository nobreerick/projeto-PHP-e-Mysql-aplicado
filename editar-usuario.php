<?php

require_once __DIR__ . '/vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\User;
use Nobreerick\MyphpsqlWeb\infra\dao\UsersDao;

$usersDao = new UsersDao();

$urlOrigem = "admin.php";

$id = (int) $_POST['id'];

if (isset($_POST['voltar'])) {
    header('Location: ' . $urlOrigem);
    exit;
}

if (isset($_POST['alterarStatus'])) {
    try{
        $success = $usersDao->updateUserActiveFlagById($id);

    } catch (Exception $e) {
        echo $e;
        exit;
    }

    header('Location: ' . $urlOrigem);
    exit;
}

$user = User::retrieveUserById($id);

if (isset($_POST["editar"])) {

    $nome = $_POST["nome"] === '' ? $user->getName() : $_POST["nome"] ?? $user->getName();
    $email = $_POST["email"] === '' ? $user->getEmail() : $_POST["email"] ?? $user->getEmail();

    $userData = [
      'id' => $id,
      'nome' => $nome,
      'email' => $email
    ];

    try {
        $success = $usersDao->updateUserData($userData['id'], $userData);
    } catch (Exception $e) {
        echo "Erro ao editar o usuário: " . $e->getMessage();
    }

    if (isset($_POST['password']) 
    && isset($_POST['repassword']) 
    && $_POST['password'] === $_POST['repassword'] 
    && $_POST['password'] !== '') {
        
        $newPassword = $_POST['password'];
        try {
            $usersDao->updateUserPassword($id, $newPassword);
        } catch (Exception $e) {
            echo "Erro ao atualizar a senha: " . $e->getMessage();
            exit;
        }
    }     
    header("Location: admin.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Login</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Editar usuário Serenatto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form">
  <form method="post">
    <input type="hidden" name="id" value="<?= $user->getId() ?>">
    
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="<?= $user->getName() ?>" >

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" placeholder="<?= $user->getEmail() ?>" >

    <label for="password">Senha</label>
    <input type="password" id="password" name="password" placeholder="Digite a sua nova senha">

    <label for="repassword">Repetir Senha</label>
    <input type="password" id="repassword" name="repassword" placeholder="Digite a sua nova senha novamente">

    <input type="submit" class="botao-cadastrar" name="editar" value="Editar"/>
  </form>
  <form method="post">
    <input type="hidden" name="Url-Origem" value="<?= $urlOrigem ?>">
    <input type="submit" class="botao-cadastrar" name="voltar" value="Voltar"/>
  </form>
  </section>
</main>
</body>
</html>