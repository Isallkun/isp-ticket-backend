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
        $ticket = Ticket::create($request->all());
        TicketLog::create(['ticket_id' => $ticket->id, 'status' => 'Open', 'user_id' => Auth::id()]);
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
    }

    public function updateStatus(Request $req, $id) {
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
