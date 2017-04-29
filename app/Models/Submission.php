<?php

namespace App\Models;

use ParsedownExtra;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Submission
{
    const ANSWERSET_DELIMITER = '-------------------------------------------------------------------------------------------';

    /** @var string */
    protected $id;

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
     * @param string $submissionId
     * @return Submission
     */
    public static function findById($submissionId)
    {
        // 1. Load the quiz.
        $quizName = substr($submissionId, 0, strpos($submissionId, '-'));
        $quiz = Quiz::find($quizName);

        $submissionPath = self::getSubmissionsPath();
        $submissionFile = $submissionId . '.md';

        if (!is_readable($submissionPath . '/' . $submissionFile)) {
            // See if the test has been graded:
            $submissionPath = self::getSubmissionsPath(true);
            if (!is_readable($submissionPath . '/' . $submissionFile)) {
                throw new FileException('Could not find/open the submission.');
            }
        }

        $submission = new Submission($quiz, []);
        $submission->loadSubmission(file_get_contents($submissionPath . '/' . $submissionFile));
        $submission->setId($submissionId);

        return $submission;
    }

    /**
     * @param $quizName
     * @param $email
     * @param $pin
     * @return Submission
     */
    public static function find($quizName, $email, $pin)
    {
        $submissionId = preg_replace('/[^a-zA-Z0-9_.]/', '', $quizName) . '-' . md5("$email$pin");
        $submission = self::findById($submissionId);

        return $submission;
    }

    public static function getSubmissionsPath($gradedPath = false)
    {
        $submissionPath = storage_path('submissions');
        if ($gradedPath) {
            $submissionPath .= '/graded';
        }

        return $submissionPath;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        $answerSetDelimiter = self::ANSWERSET_DELIMITER;
        $submission = '';
        foreach ($this->quiz->getTextQuestions() as $i => $question) {
            $quotedAnswer = preg_replace('/^/m', '> ', $this->answers[$i]);
            $submission .= <<<TEXT
$question

$quotedAnswer

$answerSetDelimiter

TEXT;
        }

        // Remove the last delimiter.
        $submission = str_replace_last($answerSetDelimiter, '', $submission);

        // 6. Save the submission.
        if (!is_writable($submissionPath)) {
            throw new FileException("Cannot write to '$submissionFile'.");
        }
        file_put_contents($submissionFile, $submission);
    }

    public function prepForGrading()
    {
        $answerSets = explode(self::ANSWERSET_DELIMITER . "\n", $this->submission);
        foreach ($answerSets as $id => &$answerSet) {
            $answerSet =
                ($id + 1) . ". <input type=\"checkbox\" name=\"wrong[$id]\"/> " .
                $answerSet .
                "<textarea name=\"comments[$id]\" style=\"width: 600px\"></textarea>" .
                "\n";
        }

        $this->submission = implode(self::ANSWERSET_DELIMITER . "\n", $answerSets);

        return $this;
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

    public function grade($wrong, $comments, $grade)
    {
        $answerSets = explode(self::ANSWERSET_DELIMITER . "\n", $this->submission);
        foreach ($answerSets as $id => &$answerSet) {
            $rightOrWrongImage = !empty($wrong[$id]) ?
                '![wrong](/images/wrong.png) ' :
                '![correct](/images/correct.png) ';
            $comment = !empty($comments[$id]) ? $comments[$id] . ' {.explanation}': '';
            $answerSet =
                $rightOrWrongImage . ($id + 1) . '. ' .
                $answerSet . "\n" .
                '### ' . $comment . "\n\n";

        }

        $this->submission = implode(self::ANSWERSET_DELIMITER . "\n", $answerSets);

        $oldFileName = self::getSubmissionsPath(false) . '/' . $this->getId() . '.md';
        $newFileName = self::getSubmissionsPath(true) . '/' . $this->getId() . '.md';

        if (!file_put_contents($newFileName, $this->getText())) {
            throw new FileException('Could not write graded test for ' . $this->getId());
        }

        unlink($oldFileName);

        return $this;
    }
}
