<?php
session_start();

if (!Sessions::validate() || !Rights::checkRights('all')) {
    http_response_code(401);
    header("Location: /");
    exit();
}

$questions = $db->query("SELECT * FROM questions WHERE topic = :topic", [
    "topic" => $_SESSION['quiz_topic']
])->fetchAll();

$score = 0;
$total = count($questions);
$summary = [];

foreach ($questions as $index => $q) {
    $userAnswer = $_SESSION['user_answers'][$index] ?? null;
    $isCorrect = ($userAnswer == $q['correct_answer']);
    
    if ($isCorrect) $score++;

    $summary[] = [
        "question" => $q['question'],
        "user_answer" => $q["option_$userAnswer"] ?? "No answer",
        "correct_answer" => $q["option_" . $q['correct_answer']],
        "is_correct" => $isCorrect
    ];
}

unset($_SESSION['currentPosition']);
unset($_SESSION['user_answers']);

require "views/quiz/results.view.php";