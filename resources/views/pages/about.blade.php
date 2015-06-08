@extends('app')

@section('content')

@if( $first == 'John')
    <h1>Hi John</h1>
@else
    <h1>Hi Someone else</h1>
@endif

@unless($first == 'John')
    <h1>Isne John</h1>
@else
    <h1>IS JOHN!</h1>
@endunless


@if( $people )
<ul>

    @foreach( $people as $person )
    <li>{{ $person }}</li>
    @endforeach
</ul>
@endif

@forelse($people_FALSE as $test)
    This is a test
@empty
    This PEOPLE_FALSE does not exist
@endforelse



<h3>About Me: {{ $first }} {{ $last }} </h3>
@stop
