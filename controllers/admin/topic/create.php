<?php

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$pageTitle = "Pievienot topiku";
$errors = [];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        $errors[] = "CSRF token validation failed";
    } else {

        $db->query("INSERT INTO topics (name) VALUES (:name)", [
            "name" => $_POST['name']
        ]);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}



require "views/admin/topic/create.view.php";