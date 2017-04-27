<?php

namespace App\Models;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Submission
{
    /** @var Quiz */
    protected $quiz;

    /** @var array */
    protected $answers;

    public function __construct(Quiz $quiz, array $answers)
    {
        $this->quiz = $quiz;
        $this->answers = $answers;
    }

    public function save($email, $pin)
    {
        // 1. Get the quiz's name.
        $quizName = $this->quiz->getName();

        // 2. Hash the submission's file name.
        $submissionPath = storage_path('submissions');
        $submissionFile = $submissionPath . '/' . preg_replace('/[^a-zA-Z0-9_.]/', '', $quizName) . '-' . md5("$email$pin") . '.md';

        // 5. Combine the questions with the answers.
        $submission = '';
        foreach ($this->quiz->getTextQuestions() as $i => $question) {
            $quotedAnswer = preg_replace('/^/m', '> ', $this->answers[$i]);
            $submission .= <<<TEXT
$question

$quotedAnswer
-----

TEXT;
        }

        // 6. Save the submission.
        if (!is_writable($submissionPath)) {
            throw new FileException("Cannot write to '$submissionFile'.");
        }
        file_put_contents($submissionFile, $submission);
    }
}
