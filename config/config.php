<?php

if (!defined("BASE_URL")) {
    $isLocalhost = $_SERVER['HTTP_HOST'] === 'localhost';

    define("BASE_URL", $isLocalhost ? "http://localhost/clean-blog/" : "https://bloghub-website.infinityfreeapp.com/");
}

try {
    $host = "sql303.infinityfree.com";
    $dbname = "if0_39102576_cleanblog";
    $user = "if0_39102576";
    $pass = "RM4cPYJhKjTr5";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo $e->getMessage();
}

