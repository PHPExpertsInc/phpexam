@extends('layouts.default')
@section('pageTitle', 'PHP Quiz: Intro')
@section('content')
    <h3>Intermediate PHP Quiz</h3>
    <p><img class="align-left" src="/images/noob.png" width="136" height="140" />
    <p>
        This test is geared for people who want to proceed in career of PHP with 2 to 3 years of experience.
    </p>
    <hr />
    <form method="post" action="/submission">
        {{ csrf_field() }}
        <input type="hidden" name="quiz" value="intermediate"/>
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


