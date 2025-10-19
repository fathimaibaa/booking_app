<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
   public function index(Request $request)
{
    $query = \App\Models\Booking::query();

    //  Search by name or email
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('customer_name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    //  Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $bookings = $query->latest()->get();

    return view('bookings.index', compact('bookings'));
}




    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string',
        'email' => 'required|email|unique:bookings,email',
        'booking_date' => 'required|date|before_or_equal:today',
        'service_type' => 'required|string',
        'status' => 'required|string',
    ]);

    Booking::create($request->all());

    return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
}


    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
{
    $request->validate([
        'customer_name' => 'required|string',
        'email' => 'required|email|unique:bookings,email,' . $booking->id,
        'booking_date' => 'required|date|before_or_equal:today',
        'service_type' => 'required|string',
        'status' => 'required|string',
    ]);

    $booking->update($request->all());

    return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
}


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }
}
