<?php

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$pageTitle = "Pievienot topiku";
$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $db->query("INSERT INTO topics (name) VALUES (:name)", [
        "name" => $_POST['name']
    ]);
}



require "views/admin/topic/create.view.php";