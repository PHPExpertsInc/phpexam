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

<div class="col_12">
    <ol>
        @foreach($questions as $questionId => $question)
            <li>
                {!! $question !!}
                <textarea name="question{{$questionId + 1}}" style="width: 600px"></textarea>
            </li>

        @endforeach
    </ol>
</div>
@stop