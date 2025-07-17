<?php 


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
    <h1>Login Serenatto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form">
  <form action="#">
    
    <label for="nome">E-mail</label>
    <input type="text" id="nome" placeholder="Digite o seu nome" required>
    
    <label for="email">E-mail</label>
    <input type="email" id="email" placeholder="Digite o seu e-mail" required>

    <label for="password">Senha</label>
    <input type="password" id="password" placeholder="Digite a sua senha" required>

    <label for="repassword">Repetir Senha</label>
    <input type="password" id="repassword" placeholder="Digite a sua senha novamente" required>

    <input type="submit" class="botao-cadastrar" value="Entrar"/>
  </form>
  <button class="botao-cadastrar" onclick="window.location.href='login.php'">Voltar</button>
  </section>
</main>
</body>
</html>


<!--
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
senha VARCHAR(255) NOT NULL,
data_criacao TIMESTAMP,
data_modificacao TIMESTAMP,
ativo BOOLEAN DEFAULT FALSE
-->