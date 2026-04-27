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

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        $errors['csrf'] = "CSRF token validation failed";
    } else {
        $question = new Question(
            $_POST['topic'] ?? null,
            $_POST['question'] ?? null,
            $_POST['choices'][0] ?? null,
            $_POST['choices'][1] ?? null,
            $_POST['choices'][2] ?? null,
            $_POST['choices'][3] ?? null,
            $_POST['correct'] ?? null
        );

        $questionRepository = new QuestionRepository($db);
        
        try {
            $questionRepository->insert($question);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            header("Location: /admin");
            exit();
        } catch (Exception $e) {
            http_response_code(500);
            $errors['insert'] = "Failed to add question: " . $e->getMessage();
        }
    }
}

require "views/admin/quiz/create.view.php";