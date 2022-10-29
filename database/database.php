<?php

$dns = 'mysql:host=localhost;dbname=blog';
$user = getenv("DB_USER");
$pwd = getenv("DB_PWD");

try {
    $pdo = new PDO($dns, $user, $pwd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "ERROR : " . $e->getMessage();
}

return $pdo;
