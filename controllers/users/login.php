<?php

session_start();

$pageTitle = "login page";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $sql = "SELECT * FROM users WHERE username = :username";
    $params = ["username" => $_POST["username"]];
    $user = $db->query($sql, $params)->fetch();

    if(password_verify($_POST['password'], $user['password'])) {
        $_SESSION['userRights'] = $user['rights'];
        $_SESSION['username'] = $user['username'];
        header("Location: /"); exit();
    } else {
        $errors['login'] = "password or username incorrect";
        header("Location: /login"); exit();
    }

}

require("views/users/login.view.php");