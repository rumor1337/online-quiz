<?php

$pageTitle = "register page";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $params = ["username" => $_POST["username"]];
    $validateSql = "SELECT username FROM users WHERE username = :username";
    
    $validation = $db->query($validateSql, $params)->fetch();


    if(!$validation) {
        $params = ["username" => $_POST["username"], "password" => password_hash($_POST["password"], PASSWORD_BCRYPT), "rights" => "user"];
        $sql = "INSERT INTO users (username, password, rights) VALUES (:username, :password, :rights)";
        $db->query($sql, $params);
        header("Location: /"); exit();
    } else {
        $errors['register'] = "User already registered";
    }
}

require("./views/users/register.view.php");