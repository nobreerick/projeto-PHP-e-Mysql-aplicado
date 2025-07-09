<?php 

namespace Nobreerick\MyphpsqlWeb\Infra;

use PDO;

function createConnection(string $driverConfig): PDO
{
    $pdo = new PDO($driverConfig);
    return $pdo;
}
