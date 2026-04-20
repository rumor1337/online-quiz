<?php

require "Sessions.php";
require "Validator.php";

session_start();

if (Sessions::validate()) {
    header("Location: /");
    exit();
}

$pageTitle = "login page";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $user = $db->query("SELECT * FROM users WHERE username = :username", ["username" => $username])->fetch();

    if ($user && password_verify($password, $user['password'])) {
        Sessions::set($user['username'], $user['rights']);

        header("Location: /");
        exit();
    }

    $errors['login'] = "Password or username incorrect";
}

require "views/users/login.view.php";