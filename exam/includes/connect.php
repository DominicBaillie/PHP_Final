<?php

declare(strict_types=1);

$host = "172.31.22.43";
$db = "Dominic200645091";
$user = "Dominic200645091";
$pass = "KmfcXB3TdN";

$dsn = "mysql:host=$host;port=3306;dbname=$db;charset=utf8mb4";

try 
{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch (PDOException $e) 
{
    die("Connection failed: " . $e->getMessage());
}

?>