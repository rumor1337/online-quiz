<?php

$pageTitle = "take the quiz";

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$questions = $db->query("SELECT * FROM questions WHERE topic = :topic", [
    "topic" => $_POST['topic'] ?? $_SESSION['quiz_topic'],
])->fetchAll();

if (!isset($_SESSION['currentPosition']) || isset($_POST['reset'])) {
    $_SESSION['currentPosition'] = 0;
    $_SESSION['quiz_topic'] = $_POST['topic'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['next_question'])) {
    
    $_SESSION['user_answers'][$_SESSION['currentPosition']] = $_POST['answer'];

    if ($_SESSION['currentPosition'] < count($questions) - 1) {
        $_SESSION['currentPosition']++;
    } else {
        header("Location: /results");
        exit();
    }
}

$currentQuestion = $questions[$_SESSION['currentPosition']];
$totalQuestions = count($questions);

require "views/quiz/show.view.php";