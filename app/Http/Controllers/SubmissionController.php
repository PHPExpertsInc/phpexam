<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use ParsedownExtra;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SubmissionController extends Controller
{
    public function save(Request $request)
    {
        // 1. Get the basic inputs.
        $quizName = $request->input('quiz');
        $email = $request->input('email');
        $pin = $request->input('pin');

        // 2. Load the quiz.
        $quiz = Quiz::find($quizName);

        // 3. Get the user's answers.
        $answers = $request->input('answers');

        // 4. Hash the submission's file name.
        $submissionPath = storage_path('submissions');
        $submissionFile = $submissionPath . '/' . preg_replace('/[^a-zA-Z0-9_.]/', '', $quizName) . '-' . md5("$email$pin") . '.md';

        // 5. Combine the questions with the answers.
        $submission = '';
        foreach ($quiz->getTextQuestions() as $i => $question) {
            $quotedAnswer = preg_replace('/^/m', '> ', $answers[$i]);
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
