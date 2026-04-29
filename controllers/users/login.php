<?php

session_start();

if (Sessions::validate()) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$pageTitle = "pieteikties";
$errors = [];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        $errors['csrf'] = "CSRF verifikācija neizdevās";
    } else {
        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        $user = $db->query("SELECT * FROM users WHERE username = :username", ["username" => $username])->fetch();

        if ($user && password_verify($password, $user['password'])) {
            Sessions::set($user['username'], $user['rights']);

            header("Location: /");
            exit();
        }

        $errors['login'] = "Parole vai lietotājvārds ir nepareizs";
    }
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require "views/users/login.view.php";