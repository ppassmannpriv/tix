<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketsController extends AbstractController
{
    public function index()
    {
        $tickets = Ticket::all();

        return view('tickets.index', ['tickets' => $tickets]);
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', ['ticket' => $ticket]);
    }
}
