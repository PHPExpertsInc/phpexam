<?php

namespace App\Http\Controllers;

use ParsedownExtra;

class QuizController extends Controller
{
    /** @var ParsedownExtra */
    protected $parsedown;

    /** @var array */
    protected $questions;

    public function __construct()
    {
        $this->parsedown = new ParsedownExtra();
    }

    protected function loadQuiz($quiz)
    {
        // 1. Make sure that the quiz file actually exists.
        $quizFile = base_path('resources/quizzes') . "/$quiz.md";
        if (!is_readable($quizFile)) {
            abort(404, "The requested quiz could not be found.");
        }

        // 2. Load the file.
        $quizContents = file_get_contents($quizFile);

        // 3. Parse the file.
        $this->questions = json_decode($quizContents);

        // 4. Convert from Markdown to HTML.
        foreach ($this->questions as &$question) {
            $question = $this->parsedown->text($question);
        }
    }

    public function show($quiz)
    {
        $this->loadQuiz($quiz);

        return view('quiz.beginner', [
            'questions' => $this->questions,
        ]);
    }
}
