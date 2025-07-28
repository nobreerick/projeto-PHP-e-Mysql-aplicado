<?php
require_once 'vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\domain\models\Product;

$produtos = Product::retrieveAllProducts();

?>

<table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descricão</th>
          <th>Valor</th>
          <th>Arquivo da imagem</th>
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
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>