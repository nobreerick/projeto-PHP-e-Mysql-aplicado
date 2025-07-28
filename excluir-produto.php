<?php 

require_once __DIR__ . '/vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\dao\ProductsDao;

$productDao = new ProductsDao();

$productDao->deleteProductById($_POST['id']);
//$_POST é uma variável superglobal em PHP que é usada para coletar dados de formulários enviados via método POST no corpo da requisição.

header("Location: admin.php");
// O PHP envia um cabeçalho para o navegador e redireciona para a página admin.php após a exclusão do produto.

/*
$productDao->deleteProductById($_GET['id']);*/
//$_GET é uma variável superglobal em PHP que é usada para coletar dados de formulários enviados via método GET.
