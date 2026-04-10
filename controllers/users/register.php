<?php

$pageTitle = "register page";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sql = "INSERT INTO users (username, password, rights) VALUES (:username, :password, :rights)";
    $params = ["username" => $_POST["username"], "password" => password_hash($_POST["password"], PASSWORD_BCRYPT), "rights" => "user"];
    $db->query($sql, $params);
    header("Location: /"); exit();
}

require("./views/users/register.view.php");