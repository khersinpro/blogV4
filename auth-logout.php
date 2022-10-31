<?php 
require_once __DIR__.'/database/database.php';
$authDb = require_once __DIR__.'/database/security.php';
$sessionId = $_COOKIE["session"] ?? "";

if($sessionId) {
    $authDb->logout($sessionId);
    header('Location: /auth-login.php');
}