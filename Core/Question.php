<?php

class Question {

    private $topic;
    private $question;
    private $option_1;
    private $option_2;
    private $option_3;
    private $option_4;
    private $correctAnswer;

    public function __construct($topic, $question, $option_1, $option_2, $option_3, $option_4, $correctAnswer) {
        $this->topic = $topic;
        $this->question = $question;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->correctAnswer = $correctAnswer;
    }

    public function toInsertParams() {
        return [
            "topic" => $this->topic,
            "question" => $this->question,
            "option_1" => $this->option_1,
            "option_2" => $this->option_2,
            "option_3" => $this->option_3,
            "option_4" => $this->option_4,
            "correct_answer" => $this->correctAnswer
        ];
    }
}