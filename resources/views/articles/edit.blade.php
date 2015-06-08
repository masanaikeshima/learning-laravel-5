@extends('app')

@section('content')

    <h1>Edit Article - {!! $article->title !!}</h1>
    <br/>

    <!-- Set the form path to the update function using the PATCH method, we also want to pass along the article id so we know what to update -->
    {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id] ]) !!}


    <!-- We can add an extra parameter to pass through to the included view -->
    @include('articles._form', ['submitButtonText' => 'Update Article'])

    {!! Form::close() !!}

@stop