<?php
$caminhoBanco = 'host=172.26.0.2;dbname=serenatto;user=root;password=ROOT_PASSWORD';
$pdo = new PDO('mysql:' . $caminhoBanco);

var_dump($pdo);
