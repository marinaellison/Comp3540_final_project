<?php
session_start();
$host = "localhost";
$dbname = "tru_gaming_club";
$user = "root";
$pass = "";
try
{
    $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname",
    $user,
    $pass
    );
    $pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
    );
}
catch(PDOException $e)
{
    die($e->getMessage());
}
?>
