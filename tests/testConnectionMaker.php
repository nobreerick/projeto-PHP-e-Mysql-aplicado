<?php
//template de conexão
require_once __DIR__ . '/../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\infra\ConnectionMaker;

$cursor = new ConnectionMaker();

var_dump($cursor->isConnected());



