<?php

$pageTitle = "select quiz";

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$topics = $db->query("SELECT * FROM topics")->fetchAll();

require "views/quiz/select.view.php";