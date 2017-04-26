@extends('layouts.default')
@section('pageTitle', 'PHP Quiz: Intro')
@section('content')
<h3>PHP Quiz: Intro</h3>
<p><img class="align-left" src="/images/php-logo.jpg" width="250" height="140" />
    This project is dedicated to helping you determine your level of PHP and general programming aptitude.</p>

<p>It is a completely anonymous test. Your email address is stored as a one-way, salted hash with the same security
    as a password. For all intents, it is your password.</p>

<p>Good luck! And remember to have fun and always learn more!</p>


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