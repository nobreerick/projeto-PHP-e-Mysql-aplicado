<?php 
    require_once 'vendor/autoload.php';
    
    use Nobreerick\MyphpsqlWeb\domain\models\Product;
    use Nobreerick\MyphpsqlWeb\domain\models\User;
    
    $produtos = Product::retrieveAllProducts();

    $usuarios = User::retrieveAllUsers();
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Admin</title>
</head>
<body>
  <main>
    <section class="container-admin-banner">
      <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
      <h1>Admistração Serenatto</h1>
      <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <button class="botao-cadastrar" id="btn-produtos">Lista de Produtos</button>
    <button class="botao-cadastrar" id="btn-usuarios">Lista de Usuários</button>
  <section class="container-table" id="tabela-produtos">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descricão</th>
          <th>Valor</th>
          <th colspan="2">Arquivo da imagem</th>
          <th colspan="2">Ações</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($produtos as $produto): ?> 
      <tr>
        <td><?=$produto->getName();?></td>
        <td><?=$produto->getType();?></td>
        <td><?=$produto->getDescription()?></td>
        <td><?=$produto->getFormattedPrice()?></td>
        <td>
          <img 
          src="<?= $produto->getImageWithDirectory("img/"); ?>" 
          alt="<?= "Preview " . $produto->getName(); ?>"
          width="100" height="100">
        </td>
        <td><?=$produto->getImage();?></td>
        <td>
          <form action="./editar-produto.php" method="POST">
            <input type="hidden" name="id" value="<?=$produto->getId();?>">
            <button type="submit" class="botao-cadastrar" value="Editar">Editar</button>
          </form>
        <!--  <a class="botao-editar" href="editar-produto.php">Editar</a></td>-->
        <td>
          <form action="excluir-produto.php" method="post"> 
            <input type="hidden" name="id" value="<?=$produto->getId();?>">
            <input type="submit" class="botao-cadastrar" value="Excluir" style="color: red;">
          </form>
        </td>  
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <a class="botao-cadastrar" id="cadastrar-produto" href="cadastrar-produto.php">Cadastrar produto</a>
  <form action="#" method="post">
    <input type="submit" id="relatorio-produtos" class="botao-cadastrar" value="Baixar Relatório de Produtos"/>
  </form>
  </section>
  <section class="container-table" id="tabela-usuarios">
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Data de criação</th>
          <th>Data de modificação</th>
          <th>Status</th>
          <th colspan="3">Ações</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($usuarios as $usuario): ?> 
      <tr>
        <td><?=$usuario->getName();?></td>
        <td><?=$usuario->getEmail();?></td>
        <td><?=$usuario->getCreationDate()?></td>
        <td><?=$usuario->getModifyDate()?></td>
        <td><?=$usuario->getIsActive() ? 'Ativo' : 'Inativo'?></td>
        <td>
          <form action="./editar-usuario.php" method="POST">
            <input type="hidden" name="id" value="<?=$usuario->getId();?>">
            <button type="submit" class="botao-cadastrar" name="editar" value="Editar">Editar</button>
          </form>
        </td>
        <td>
          <form action="./editar-usuario.php" method="post"> 
            <input type="hidden" name="id" value="<?=$usuario->getId();?>">
            <button type="submit" class="botao-cadastrar" name="alterarStatus" value="Alterar Status">Alterar Status</button>
          </form>
        </td>   
        <td>
          <form action="./excluir-usuario.php" method="post"> 
            <input type="hidden" name="id" value="<?=$usuario->getId();?>">
            <button type="submit" class="botao-cadastrar" name="excluir" value="Excluir" style="color: red;">Excluir</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <form action="cadastrar-usuario.php" method="post">
      <input type="hidden" name="Url-Origem" value="admin.php">
      <input class="botao-cadastrar" id="cadastrar-usuario" type="submit" name="cadastrar-usuario" value="Cadastrar Usuário">
    </form>
  <form action="gerador-pdf.php" method="post">
    <input type="submit" id="relatorio-usuarios" class="botao-cadastrar" value="Baixar Relatório de Usuários"/>
  </form>
</section>
</main>
</body>
</html>

<script>
  const btnProdutos = document.getElementById('btn-produtos');
  const btnUsuarios = document.getElementById('btn-usuarios');
  const tabelaProdutos = document.getElementById('tabela-produtos');
  const tabelaUsuarios = document.getElementById('tabela-usuarios');
  const cadastrarProduto = document.getElementById('cadastrar-produto');
  const relatorioProdutos = document.getElementById('relatorio-produtos');
  const cadastrarUsuario = document.getElementById('cadastrar-usuario');
  const relatorioUsuarios = document.getElementById('relatorio-usuarios');

  // Inicialmente mostra apenas produtos
  tabelaProdutos.style.display = 'block';
  tabelaUsuarios.style.display = 'none';
  cadastrarProduto.style.display = 'inline-block';
  relatorioProdutos.style.display = 'inline-block';
  cadastrarUsuario.style.display = 'none';
  relatorioUsuarios.style.display = 'none';

  btnProdutos.addEventListener('click', function() {
    tabelaProdutos.style.display = 'block';
    tabelaUsuarios.style.display = 'none';
    cadastrarProduto.style.display = 'inline-block';
    relatorioProdutos.style.display = 'inline-block';
    cadastrarUsuario.style.display = 'none';
    relatorioUsuarios.style.display = 'none';
  });

  btnUsuarios.addEventListener('click', function() {
    tabelaProdutos.style.display = 'none';
    tabelaUsuarios.style.display = 'block';
    cadastrarProduto.style.display = 'none';
    relatorioProdutos.style.display = 'none';
    cadastrarUsuario.style.display = 'inline-block';
    relatorioUsuarios.style.display = 'inline-block';
  });
</script>

