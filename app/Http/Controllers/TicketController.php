<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets for the authenticated user.
     */
    public function index()
    {
        // Log that the tickets page was accessed
        Log::info('Tickets page accessed.');

        // Fetch all tickets
        $tickets = Ticket::all();

        // Log the number of tickets fetched
        Log::info('Number of tickets found: ' . $tickets->count());

        // Return view with tickets
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        // Log the incoming request data for debugging
        Log::info('Create Ticket Request Data:', $request->all());

        // Validate the form inputs
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Log the successful validation
        Log::info('Ticket data validated successfully. Creating ticket...');

        // Create a new ticket
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        // Log the successful creation
        Log::info('Ticket created successfully with ID: ' . $ticket->id);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    }
    public function edit($id)
    {
        // Debug: Log ticket editing
        Log::info('Editing ticket ID: ' . $id);

        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        // Log the incoming request data for debugging
        Log::info('Update Ticket Request Data:', $request->all());

        // Validate the form inputs
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string|in:Open,In Progress,Closed',
        ]);

        // Log the successful validation
        Log::info('Ticket data validated successfully. Updating ticket...');

        // Find the ticket to update
        $ticket = Ticket::findOrFail($id);

        // Log if ticket is found
        Log::info('Ticket found for ID: ' . $ticket->id);

        // Update the ticket
        $ticket->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        // Log the successful update
        Log::info('Ticket updated successfully with ID: ' . $ticket->id);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        // Debug: Log ticket deletion process
        Log::info('Deleting ticket ID: ' . $ticket->id);

        // Delete the ticket
        $ticket->delete();

        // Debug: Log after ticket is deleted
        Log::info('Ticket deleted successfully for ticket ID: ' . $ticket->id);

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully!');
    }

    public function answer($id)
    {
        $ticket = Ticket::findOrFail($id);
        $messages = $ticket->messages;


        // Debug: Log the action of answering a ticket
        // Log::info('Preparing to answer ticket ID: ' . $id);
        Log::info('Viewing ticket details', [
            'ticket' => $ticket->toArray(),
            'messages' => $messages->toArray(),
        ]);

        $ticket = Ticket::findOrFail($id);
        return view('tickets.answer', compact('ticket', 'messages'));
    }

    public function updateAnswer(Request $request, $id)
    {
        // Log the start of the answer update process
        Log::info('Starting to update answer for ticket ID: ' . $id);

        $ticket = Ticket::findOrFail($id);

        // Log the current answer before updating
        Log::info('Current answer for ticket ID ' . $id . ': ' . $ticket->answer);

        // Update the ticket's answer
        $ticket->answer = $request->answer; // Assuming there is an 'answer' column in your tickets table
        $ticket->save();

        // Log the new answer after update
        Log::info('Answer updated successfully for ticket ID: ' . $id);

        // Return success message
        return redirect()->route('tickets.index')->with('success', 'Answer updated successfully.');
    }

    public function show($ticketId)
{
    $ticket = Ticket::findOrFail($ticketId);

    // মেসেজ গুলি টিকিটের সাথে লোড করুন
    $messages = $ticket->messages;

    // লগ করার জন্য
    Log::info('Viewing ticket details', [
        'ticket' => $ticket->toArray(),
        'messages' => $messages->toArray(),
    ]);

    return view('tickets.show', compact('ticket', 'messages'));
}



    // TicketController.php
    public function storeAnswer(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        $message = new Message();
        $message->ticket_id = $ticket->id;
        $message->user_id =  Auth::id();
        $message->message = $request->message;
        $message->save();

        return redirect()->route('tickets.show', $ticket->id);
    }
}
