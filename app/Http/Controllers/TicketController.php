<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketLog;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('customer', 'logs')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create() {
        $customers = Customer::all();
        return view('tickets.form', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'category' => 'nullable|string|max:100',
        ]);

        $ticket = Ticket::create($request->all());
        TicketLog::create(['ticket_id' => $ticket->id, 'status' => 'Open', 'user_id' => Auth::id()]);
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
    }

    public function updateStatus(Request $req, $id) {
        $req->validate([
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
        ]);

        $ticket = Ticket::findOrFail($id);

        if ($req->status === 'Closed' && $ticket->status !== 'Resolved') {
            return redirect()->back()->with('error', 'Ticket must be resolved before closing');
        }

        $ticket->update(['status' => $req->status]);
        TicketLog::create(['ticket_id' => $ticket->id, 'status' => $req->status, 'user_id' => Auth::id()]);
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with('customer', 'logs.user')->findOrFail($id);
        return view('tickets.detail', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::with('customer')->findOrFail($id);
        $customers = Customer::all();
        return view('tickets.form', compact('ticket', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:Low,Medium,High,Critical',
            'category' => 'nullable|string|max:100',
        ]);

        $ticket->update($request->all());
        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        // Check if ticket can be deleted (only if it's in 'Open' status)
        if ($ticket->status !== 'Open') {
            return redirect()->route('tickets.index')->with('error', 'Can only delete tickets with Open status');
        }

        // Delete ticket logs first
        $ticket->logs()->delete();

        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
    }
}
