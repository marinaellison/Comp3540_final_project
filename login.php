<?php
require "config.php";
$username = $_POST["username"];
$password = $_POST["password"];
$sql =
"
SELECT *
FROM users
WHERE username = ?
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch();
if(
    $user &&
    password_verify(
    $password,
    $user["password_hash"]
    )
)
{
    session_regenerate_id(true);
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["username"] =  $user["username"];
    $_SESSION["role"] = $user["role"];
    echo "SUCCESS";
}
else
{   echo "FAILED"; }
