<?php

namespace App\Models;

use ParsedownExtra;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Submission
{
    /** @var Quiz */
    protected $quiz;

    /** @var array */
    protected $answers;

    /** @var string */
    protected $submission;

    public function __construct(Quiz $quiz, array $answers, ParsedownExtra $parsedown = null)
    {
        if (!$parsedown) {
            $parsedown = new ParsedownExtra();
        }
        $this->parsedown = $parsedown;

        $this->quiz = $quiz;
        $this->answers = $answers;
    }

    /**
     * @param $quizName
     * @param $email
     * @param $pin
     * @return Submission
     */
    public static function find($quizName, $email, $pin)
    {
        // 1. Load the quiz.
        $quiz = Quiz::find($quizName);

        // 2. Hash the submission's file name.
        $submissionPath = storage_path('submissions');
      $submissionFile = $submissionPath . '/' . preg_replace('/[^a-zA-Z0-9_.]/', '', $quizName) . '-' . md5("$email$pin") . '.md';
//        $submissionFile = $submissionPath . '/' . preg_replace('/[^a-zA-Z0-9_.]/', '', $quizName) . '-' . $email . '.md';

        if (!is_readable($submissionFile)) {
            throw new FileException('Could not find/open the submission.');
        }

        $submission = new Submission($quiz, []);
        $submission->loadSubmission(file_get_contents($submissionFile));

        return $submission;
    }

    public function loadSubmission($submission)
    {
        $this->submission = $submission;
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

    public function getText()
    {
        return $this->submission;
    }

    public function getHtml()
    {
        // Convert from Markdown to HTML.
        return $this->parsedown->text($this->submission);
    }
}
