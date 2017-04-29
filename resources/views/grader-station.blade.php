@extends('layouts.default')
@section('pageTitle', 'PHP Quiz: Intro')
@section('content')
<h3>PHP Quiz: Intro</h3>
<p><img class="align-left" src="/images/php-logo.jpg" width="250" height="140" />
<p>View your results!</p>

    <div class="col_12">
    @if (!empty($ungradedSubmissions))
        <h2>Ungraded Submissions</h2>
        <ol>
            @foreach($ungradedSubmissions as $sub)
                <li><a href="/submission/grade/{{$sub}}">{{$sub}}</a></li>
            @endforeach
        </ol>
    @endif
    </div>
    <div class="col_12">
        @if (!empty($gradedSubmissions))
            <h2>Graded Submissions</h2>
            <ol>
                @foreach($gradedSubmissions as $sub)
                    <li><a href="/submission/view/{{$sub}}">{{$sub}}</a></li>
                @endforeach
            </ol>
        @endif
    </div>

<hr />
    @if (!empty($submission))
    <form method="post" action="/submission/grade/{{$submissionId}}">
        {{ csrf_field() }}

        {!! $submission !!}
        <div><input type="number" name="grade"/></div>
        <div><input type="submit" value="Grade"/></div>
    </form>
    @endif
@stop