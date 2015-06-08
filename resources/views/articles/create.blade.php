@extends('app')

@section('content')

    <h1>Write a new article</h1>
    <hr/>

    <!-- Pass through an empty instance of an Article to support the published_date being undefined -->
    {!! Form::model($article = new \App\Article, ['url' => 'articles']) !!}

        <!-- We can add an extra parameter to pass through to the included view -->
        @include('articles._form', ['submitButtonText' => 'Add Article'])

    {!! Form::close() !!}

    <?php
     // $errors variable is always defined and doesnt need to be setup manually
     // {{ var_dump($errors) }}
    ?>

@stop
