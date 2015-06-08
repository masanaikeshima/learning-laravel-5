@extends('app')

@section('content')
    <h1>Articles</h1>

    @foreach($articles as $article)
        <article>
            <h2>
                <?php
                // option 1 - relative url
                // <a href="./articles/{{ $article->id }}">{{ $article->title }}</a>

                // option 2 - specify the controller@method then an array of the values to be passed
                // <a href="{{ action('ArticlesController@show', [ $article->id ]) }}">{{ $article->title }}</a>

                // option 3 - specify the segment, then the next segment (absolute url)
                ?>
                <a href="{{ url('/articles', $article->id) }}">{{ $article->title }}</a>

            </h2>
            <div class="body">{{ $article->body }}</div>
        </article>
    @endforeach

@stop
