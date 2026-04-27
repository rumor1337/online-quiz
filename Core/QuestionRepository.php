<?php

class QuestionRepository {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insert($question) {
        $this->db->query(
            "INSERT INTO questions (topic, question, option_1, option_2, option_3, option_4, correct_answer) VALUES (:topic, :question, :option_1, :option_2, :option_3, :option_4, :correct_answer)",
            $question->toInsertParams()
        );
    }

    public function getByTopic($topic) {
        return $this->db->query("SELECT * FROM questions WHERE topic = :topic", ["topic" => $topic])->fetchAll();
    }

    public function getTopicIdByName($name) {
        $topic = $this->db->query(
            "SELECT id FROM topics WHERE name = :name LIMIT 1",
            ["name" => $name]
        )->fetch();

        return $topic["id"] ?? null;
    }

    public function getOrCreateTopicId($name) {
        $topicId = $this->getTopicIdByName($name);

        if ($topicId !== null) {
            return (int) $topicId;
        }

        $this->db->query("INSERT INTO topics (name) VALUES (:name)", [
            "name" => $name
        ]);

        return (int) $this->db->lastInsertId();
    }

    
}
