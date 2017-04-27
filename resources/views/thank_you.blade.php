@extends('layouts.default')
@section('pageTitle', 'Thank you!')
@section('content')
    <h3>Exam submitted!</h3>
    <p><img class="align-left" src="/images/thank_you.png" width="250" height="140" />
        Thank you for taking the time to take a PHP Quiz.
    <p>Please wait for your test to be graded by one of our senior programmers.</p>
    <p>Unfortunately, viewing results is not possible at this time, but please be sure to check back later.
        Adding the functionality to view your results is a top priority for us.</p>
    <p>Remember! This test is highly anonymous, however, if you wish for people to know your results, just
        use the Share functionity on your Results page.</p>
    <hr />

    <div class="col_12">
        <div class="col_6">
            <h4>Beginner Quiz</h4>
            <p><a class="button blue large" href="/quiz/beginner">Start <i class="fa fa-forward"></i></a></p>
            <p>This quiz targets junior developers with <strong>0 to 2 years</strong> of experience.</p>
        </div>

        <div class="col_6">
            <h4>Intermediate Quiz</h4>
            <p><a class="button blue large" href="/quiz/intermediate">Start <i class="fa fa-forward"></i></a></p>
            <p>This quiz targets junior and mid-level developers with <strong>2 to 3 years</strong> of experience.</p>
        </div>
    </div>

    <div class="col_12">
        <div class="col_6">
            <h4>Intermediate+ Quiz</h4>
            <p><a class="button blue large" href="/quiz/intermediate-plus">Start <i class="fa fa-forward"></i></a></p>
            <p>This quiz targets mid-level developers with <strong>3 to 5 years</strong> of experience.</p>
        </div>

        <div class="col_6">
            <h4>Senior Quiz</h4>
            <p><a class="button blue large" href="/quiz/senior">Start <i class="fa fa-forward"></i></a></p>
            <p>This quiz targets senior developers with <strong>5+ years</strong> of experience.</p>
        </div>
    </div>
@stop