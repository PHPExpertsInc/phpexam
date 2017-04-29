<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Repositories\SubmissionRepository;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        return response()->view('submission');
    }

    protected function isGrader($email, $pin)
    {
        return (
            $email === env('GRADER_EMAIL') &&
            $pin === env('GRADER_PIN')
        );
    }

    public function showById($submissionId)
    {
        $submission = Submission::findById($submissionId);

        return response()->view('submission', [
            'submissionId' => $submissionId,
            'submission' => $submission->getHtml(),
        ]);
    }

    public function show(Request $request)
    {
        // 1. Get the basic inputs.
        $quizName = $request->input('quiz');
        $email = $request->input('email');
        $pin = $request->input('pin');

        // 2. If the user is a grader, list the ungraded tests.
        if ($this->isGrader($email, $pin)) {
            return response()->view('grader-station', [
                'ungradedSubmissions' => SubmissionRepository::listUngradedSubmissions(),
                'gradedSubmissions' => SubmissionRepository::listGradedSubmissions(),
            ]);
        }

        // Otherwise, Load the individual's submission.
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

    public function showForGrading($submissionId)
    {
        $submission = Submission::findById($submissionId);

        return response()->view('grader-station', [
            'ungradedSubmissions' => SubmissionRepository::listUngradedSubmissions(),
            'gradedSubmissions' => SubmissionRepository::listGradedSubmissions(),
            'submissionId' => $submissionId,
            'submission' => $submission->prepForGrading()->getHtml(),
        ]);
    }

    public function grade(Request $request, $submissionId)
    {
        $submission = Submission::findById($submissionId);

        $wrong = $request->input('wrong');
        $comments = $request->input('comments');
        $grade = $request->input('grade');

        $gradedSubmission = $submission->grade($wrong, $comments, $grade);

        return response()->view('grader-station', [
            'ungradedSubmissions' => SubmissionRepository::listUngradedSubmissions(),
            'gradedSubmissions' => SubmissionRepository::listGradedSubmissions(),
            'submissionId' => $submissionId,
            'submission' => $gradedSubmission->getHtml(),
        ]);

    }
}
