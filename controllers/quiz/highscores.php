<?php

$pageTitle = "High Scores";

session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$highScoreRepository = new HighScoreRepository($db);
$topicId = $_GET['topic'] ?? null;

if ($topicId) {
    $highScores = $highScoreRepository->getByTopicId($topicId);
} else {
    $highScores = $highScoreRepository->getByUsername($_SESSION['username']);
}

$topics = $db->query("SELECT * FROM topics")->fetchAll();

require "views/quiz/highscores.view.php";
