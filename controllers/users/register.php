<?php

session_start();

if (Sessions::validate()) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$pageTitle = "register page";
$errors = [];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        $errors['csrf'] = "CSRF token validation failed";
    } else {
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
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require "views/users/register.view.php";