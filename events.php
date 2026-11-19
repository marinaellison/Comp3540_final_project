<?php
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit;
}
if ($_SESSION["role"] !== "admin") {
    http_response_code(403);
    die("Access denied. Admins only.");
}