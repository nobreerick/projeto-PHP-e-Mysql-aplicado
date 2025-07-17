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
  <form id="formAcesso" action="./validar-acesso.php" method="POST">

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" placeholder="Digite o seu e-mail" required>

    <label for="password">Senha</label>
    <input type="password" id="password" name="password" placeholder="Digite a sua senha" required>

    <input type="submit" class="botao-cadastrar" name="entrar" value="Entrar"/>
  </form>
  </section>
  <div class="container-form">
    <button type="button" class="botao-cadastrar" value="NovoUsuario" onclick="window.location.href='newuser.php'">Novo Usuário</button>
    <button class="botao-cadastrar" onclick="window.location.href='index.php'">Voltar</button>
  </div>
</main>
</body>
</html>
