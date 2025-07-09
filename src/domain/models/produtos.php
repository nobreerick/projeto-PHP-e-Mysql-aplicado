<?php

namespace Nobreerick\MyphpsqlWeb\Domain\Models;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Nobreerick\MyphpsqlWeb\Infra\Connection;

$caminhoBanco = 

$testeConnection = Connection\createConnection(
    'mysql:host=