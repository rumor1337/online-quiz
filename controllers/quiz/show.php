<?php

$pageTitle = "take the quiz";

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}


if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$topic = $_POST['topic'] ?? $_SESSION['quiz_topic'] ?? null;
if ($topic === null || $topic === '' || !is_numeric($topic) || (int)$topic <= 0) {
    http_response_code(400);
    header("Location: /quiz");
    exit();
}

$topic = (int) $topic;

$questionRepository = new QuestionRepository($db);

$questions = $questionRepository->getByTopic($topic);
if (empty($questions)) {
    http_response_code(404);
    header("Location: /quiz");
    exit();
}

if (!isset($_SESSION['currentPosition']) || isset($_POST['reset'])) {
    $_SESSION['currentPosition'] = 0;
    $_SESSION['quiz_topic'] = $topic;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['next_question'])) {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        require "views/quiz/show.view.php";
        exit();
    }
    
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