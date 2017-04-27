@extends('layouts.default')
@section('pageTitle', 'PHP Quiz: Intro')
@section('content')
<h3>Beginner PHP Quiz</h3>
<p><img class="align-left" src="/images/noob.png" width="136" height="140" />
    <p>
    This test is geared for people just starting PHP to those who have had up to 2 years of experience.
    After a while, everything in this quiz should be common knowledge to any junior developer who wishes to make
    a career in PHP.
    </p>
<hr />
<form method="post" action="/submission">
    {{ csrf_field() }}
    <input type="hidden" name="quiz" value="beginner"/>
    <div class="col_12">
        <div>
        Email: <input type="email" name="email" size="35"/>&nbsp;<input type="number" name="pin" maxlength="4" size="4"/>

        </div>
        <ol>
            @foreach($questions as $questionId => $question)
                <li>
                    {!! $question !!}
                    <textarea name="answers[{{$questionId}}]" style="width: 600px"></textarea>
                </li>
            @endforeach
        </ol>
        <input type="submit" name="take_exam" value="Submit"/>
    </div>
</form>
@stop


