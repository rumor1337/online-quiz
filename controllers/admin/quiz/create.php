<?php

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$pageTitle = "Pievienot jautājumu";
$errors = [];

$topics = $db->query("SELECT * FROM topics")->fetchAll();

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $db->query("INSERT INTO questions (topic, question, option_1, option_2, option_3, option_4, correct_answer) VALUES (:topic, :question, :option_1, :option_2, :option_3, :option_4, :correct_answer)", [
        "topic" => $_POST['topic'],
        "question" => $_POST['question'],
        "option_1" => $_POST['choices'][0],
        "option_2" => $_POST['choices'][1],
        "option_3" => $_POST['choices'][2],
        "option_4" => $_POST['choices'][3],
        "correct_answer" => $_POST['correct']
    ]);
}

require "views/admin/quiz/create.view.php";