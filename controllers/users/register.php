<?php

session_start();

if (Sessions::validate()) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$pageTitle = "reģistrēties";
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

        if (!Validator::string($username, 3, 255)) {
            $errors['username'] = "Lietotājvārda garums jābūt 3 līdz 255 simboliem.";
        }

        if (!Validator::string($password, 8)) {
            $errors['password'] = "Paroles garums jābūt vismaz 8 simboliem.";
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

            $errors['register'] = "Lietotājs jau ir reģistrēts";
        }
    }
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require "views/users/register.view.php";