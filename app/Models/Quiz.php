<?php

namespace App\Models;

use ParsedownExtra;

class Quiz
{
    /** @var array */
    protected $questions;

    /** @var ParsedownExtra */
    protected $parsedown;

    public function __construct(array $questions = [], ParsedownExtra $parsedown = null)
    {
        if (!$parsedown) {
            $parsedown = new ParsedownExtra();
        }
        $this->parsedown = $parsedown;

        $this->questions = $questions;
    }

    public static function find($quizName)
    {
        // 1. Make sure that the quiz file actually exists.
        $quizFile = base_path('resources/quizzes') . "/$quizName.md";
        if (!is_readable($quizFile)) {
            abort(404, "The requested quiz could not be found.");
        }

        // 2. Load the file.
        $quizContents = file_get_contents($quizFile);

        // 3. Parse the file.
        $questions = json_decode($quizContents);

        // 4. Return a new Quiz object.
        $quiz = new self($questions);

        return $quiz;
    }

    public function getTextQuestions()
    {
        return $this->questions;
    }

    public function getHtmlQuestions()
    {
        // Convert from Markdown to HTML.
        $questions = [];
        foreach ($this->questions as $question) {
            $questions[] = $this->parsedown->text($question);
        }

        return $questions;
    }
}
