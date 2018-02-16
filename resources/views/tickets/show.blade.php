@extends('layout')

@section('content')
    <h1>{{$ticket->name}}</h1>
    <ul>
        <li>{{$ticket->vendor}}</li>
        <li>{{$ticket->user_comment}}</li>
    </ul>

    <p><a href="/blog/public/tickets">go back</a></p>
@endsection