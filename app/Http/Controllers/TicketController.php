<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ticket::filter()->paginate22();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'subject' => 'required',
            'title' => 'required',
            'priority' => 'required',
            'ref' => 'required',
            'message' => 'required'
        ]);
        $ticket = DB::transaction(function () use ($validator, $request) {

            $ticket = Ticket::create($validator->validated() + ['user_id' => auth()->user()->id]);
            $ticket->messages()->create([
                'user_id' => auth()->user()->id,
                'message' => $request->message,
                'ticket_id' => $ticket->id,
            ]);
            return $ticket;
        });

        return $this->retrieve($ticket);

    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {

        return $this->retrieve($ticket->loady());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
