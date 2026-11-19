<?php
require "config.php";
$username = $_POST["username"];
$password = $_POST["password"];
$passwordHash =
    password_hash(
    $password,
    PASSWORD_DEFAULT
    );
$sql =
"
INSERT INTO users
(username,password_hash)
VALUES
(?, ?)
";
$stmt = $pdo->prepare($sql);
$stmt->execute(
[
    $username,
    $passwordHash
]);
echo "Registration Successful";
