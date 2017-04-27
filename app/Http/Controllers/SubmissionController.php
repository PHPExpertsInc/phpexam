<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        return response()->view('submission');
    }

    public function show(Request $request)
    {
        // 1. Get the basic inputs.
        $quizName = $request->input('quiz');
        $email = $request->input('email');
        $pin = $request->input('pin');

        // 2. Load the submission.
        $submission = Submission::find($quizName, $email, $pin);

        return response()->view('submission', [
            'submission' => $submission->getHtml(),
        ]);
    }

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

        // 4. Save the submission.
        $submission = new Submission($quiz, $answers);
        $submission->save($email, $pin);

        return response()->view('thank_you');
    }
}
