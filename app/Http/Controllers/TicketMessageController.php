<?php

namespace App\Http\Controllers;

use App\Enums\Tickets\TicketStatus;
use App\Models\File;
use App\Models\TicketMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->apiValidate([
            'ticket_id' => 'required',
            'message' => 'required',
        ]);

        $ticket_message = TicketMessage::create($validator->validated() + ['user_id' => auth()->user()->id]);
        $file = $request->file('file');
        if (auth()->user()->isAdmin())
            $ticket_message->ticket()->update([
                'status' => TicketStatus::OPEN
            ]);
        $name = Str::random(10) . '-' . Carbon::now() . '.' . $file->guessClientExtension();

        $path = $file->storeAs('tickets', $name);
        $new_file = File::create([
            'path' => 'app/' . $path,
            'extension' => $file->guessClientExtension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'section' => $request->input('section'),
            'fileable_id' => $ticket_message->id,
            'fileable_type' => TicketMessage::class,
        ]);
        $ticket_message->files()->attach([$new_file->id]);
        return $this->createdResponse($ticket_message);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketMessage $ticketMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketMessage $ticketMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketMessage $ticketMessage)
    {
        //
    }
}
