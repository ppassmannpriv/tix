@extends('layouts.1col')

@section('content')
<h1>Ticket overview</h1>
<ul>
    @foreach($tickets as $ticket)
        <li><a href="tickets/{{$ticket->id}}">{{$ticket->name}}</a></li>
    @endforeach
</ul>
@endsection