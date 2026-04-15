<?php

require "Sessions.php";
require "Validator.php";

session_start();

<<<<<<< HEAD
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
        $errors['login'] = "Password or username incorrect";

    }

=======
if (Sessions::validate()) {
    header("Location: /");
    exit();
>>>>>>> 5da1286c256c691c71a1e28c3a637dafc2066397
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