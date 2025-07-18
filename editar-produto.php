<?php

require_once __DIR__ . '/vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\Product;
use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$id = (int) $_POST["id"];
$product = Product::retrieveProductById($id);

$nome = $_POST["nome"] === '' ? $product->getName() : $_POST["nome"] ?? $product->getName();
$tipo = $_POST["tipo"] === '' ? $product->getType() : $_POST["tipo"] ?? $product->getType();
$descricao = $_POST["descricao"] === '' ? $product->getDescription() : $_POST["descricao"] ?? $product->getDescription();
$imagem = $_POST["imagem"] === '' ? $product->getImage() : $_POST["imagem"] ?? $product->getImage();
$preco = $_POST["preco"] === '' ? $product->getPrice() : (float) $_POST["preco"] ?? $product->getPrice();

if (isset($_POST["editar"])) {
    $productData = [
      'id' => $id,
      'nome' => $nome,
      'tipo' => $tipo,
      'descricao' => $descricao,
      'imagem' => $imagem,
      'preco' => $preco
    ];
    
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
      $file = $_FILES['imagem'];
      $fileName = uniqid() . $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];

      if ($fileError === 0) {
          if ($fileSize < 5000000) { // 5MB
              $fileDestination = __DIR__ . '/img/' . $fileName;
              move_uploaded_file($fileTmpName, $fileDestination);
              $productData['imagem'] = $fileName;
          } else {
              echo "O arquivo é muito grande.";
              exit;
          }
      } else {
          echo "Erro ao enviar o arquivo.";
          exit;
      }
  }

    $productsDao = new ProductsDao();
    $success = $productsDao->updateProduct('id', $productData);
    if (!$success) {
      echo "Erro ao editar o produto.";
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
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Editar Produto</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Editar Produto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $_POST["id"] ?>">

      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" placeholder="<?= $product->getName() ?>">

      <div class="container-radio" >
        <div>
            <label for="cafe">Café</label>
            <input type="radio" id="cafe" name="tipo" value="Café" 
            <?= $product->getType() === 'Café' ? 'checked' : '' ?>
            >
        </div>
        <div>
            <label for="almoco">Almoço</label>
            <input type="radio" id="almoco" name="tipo" value="Almoço"
            <?= $product->getType() === 'Almoço' ? 'checked' : '' ?> 
            >
        </div>
    </div>

      <label for="descricao">Descrição</label>
      <input type="text" id="descricao" name="descricao" placeholder="<?= $product->getDescription() ?>">

      <label for="preco">Preço</label>
      <input type="text" id="preco" name="preco" placeholder="<?= $product->getFormattedPrice() ?>">

      <label for="imagem">Envie uma imagem do produto</label>
      <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="<?= $product->getImage() ?>">

      <input type="submit" name="editar" class="botao-cadastrar"  value="Editar produto"/>
    </form>

    <button class="botao-cadastrar" onclick="window.location.href='admin.php'">Voltar</button>

  </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>