<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class QuizController extends Controller
{
    public function show($quizName)
    {
        $quiz = Quiz::find($quizName);

        return view('quiz.beginner', [
            'questions' => $quiz->getHtmlQuestions(),
        ]);
    }
}
