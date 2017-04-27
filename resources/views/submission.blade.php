@extends('layouts.default')
@section('pageTitle', 'PHP Quiz: Intro')
@section('content')
<h3>PHP Quiz: Intro</h3>
<p><img class="align-left" src="/images/php-logo.jpg" width="250" height="140" />
<p>View your results!</p>

<form method="post" action="/viewSubmission">
    {{ csrf_field() }}
    <input type="hidden" name="quiz" value="beginner"/>
    <div class="col_12">
        <div>
            <div>Quiz type:</div>
            <select name="quiz">
                <option disabled="disabled"> -- SELECT -- </option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="intermediate-plus">Intermediate Plus</option>
                <option value="senior">Advanced</option>
            </select>
        </div>
        <div>
            Email: <input type="email" name="email" size="35"/>&nbsp;<input type="number" name="pin" maxlength="4" size="4"/>

        </div>
        <input type="submit" name="take_exam" value="View"/>

        @if (!empty($submission))
            {!! $submission !!}
        @endif
    </div>

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