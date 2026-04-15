<?php

require "Sessions.php";
require "Validator.php";

session_start();

if (Sessions::validate()) {
    header("Location: /");
    exit();
}

$pageTitle = "register page";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if (!Validator::string($username, 3, 255)) {
        $errors['username'] = "Username must be between 3 and 255 characters.";
    }

    if (!Validator::string($password, 8)) {
        $errors['password'] = "Password must be at least 8 characters.";
    }

    if (empty($errors)) {
        $user = $db->query("SELECT id FROM users WHERE username = :username", [
            "username" => $username
        ])->fetch();

        if (!$user) {
            $db->query("INSERT INTO users (username, password, rights) VALUES (:username, :password, :rights)", [
                "username" => $username,
                "password" => password_hash($password, PASSWORD_BCRYPT),
                "rights"   => "user"
            ]);

            session_regenerate_id(true);
            Sessions::set($username, "user");

            header("Location: /");
            exit();
        }

        $errors['register'] = "User already registered";
    }
}

require "views/users/register.view.php";