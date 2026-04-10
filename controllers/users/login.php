<?php

$pageTitle = "login page";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO users (content, category_id) VALUES (:content, :category_id)";
    $params = ["content" => $_POST["content"], "category_id" => $_POST["category_id"]];
    $db->query($sql, $params);
    header("Location: /"); exit();
}


require("views/users/login.view.php");