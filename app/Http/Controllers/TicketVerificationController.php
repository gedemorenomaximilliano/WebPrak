<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketVerificationController extends Controller
{
    public function verify($code)
    {
        $ticket = Ticket::with(['transaction.package', 'transaction.user'])
            ->where('ticket_code', strtoupper($code))
            ->firstOrFail();

        return view('tickets.verify', compact('ticket'));
    }

    public function markUsed(Ticket $ticket)
    {
        if ($ticket->status !== 'active') {
            return back()->with('error', 'Ticket is already ' . $ticket->status);
        }

        $ticket->update(['status' => 'used']);
        return back()->with('status', 'Ticket marked as used successfully.');
    }
}
