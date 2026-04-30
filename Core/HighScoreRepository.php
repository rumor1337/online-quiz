<?php

class HighScoreRepository {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save($username, $topicId, $score, $totalQuestions) {
        $this->db->query(
            "INSERT INTO high_scores (username, topic_id, score, total_questions)
             VALUES (:username, :topic_id, :score, :total_questions)",
            [
                "username" => $username,
                "topic_id" => $topicId,
                "score" => $score,
                "total_questions" => $totalQuestions
            ]
        );
    }

    public function getByUsername($username) {
        return $this->db->query(
            "SELECT hs.*, t.name as topic_name
             FROM high_scores hs
             JOIN topics t ON hs.topic_id = t.id
             WHERE hs.username = :username
             ORDER BY hs.completed_at DESC",
            ["username" => $username]
        )->fetchAll();
    }

    public function getByTopicId($topicId) {
        return $this->db->query(
            "SELECT hs.*, t.name as topic_name
             FROM high_scores hs
             JOIN topics t ON hs.topic_id = t.id
             WHERE hs.topic_id = :topic_id
             ORDER BY hs.score DESC, hs.completed_at DESC",
            ["topic_id" => $topicId]
        )->fetchAll();
    }

    public function getBestScoreByUsernameAndTopic($username, $topicId) {
        return $this->db->query(
            "SELECT *
             FROM high_scores
             WHERE username = :username AND topic_id = :topic_id
             ORDER BY score DESC
             LIMIT 1",
            ["username" => $username, "topic_id" => $topicId]
        )->fetch();
    }

    public function getTopScoresForTopic($topicId, $limit = 10) {
        return $this->db->query(
            "SELECT *
             FROM high_scores
             WHERE topic_id = :topic_id
             ORDER BY score DESC, completed_at DESC
             LIMIT :limit",
            ["topic_id" => $topicId, "limit" => $limit]
        )->fetchAll();
    }
}
