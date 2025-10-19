<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
  public function index(Request $request)
{
    $query = Booking::query();

    // Search filter
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('customer_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('service_type', 'like', "%{$search}%");
        });
    }

    // Status filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Pagination (5 per page)
    $bookings = $query->orderBy('booking_date', 'desc')->paginate(5);

    return view('bookings.index', compact('bookings'));
}





    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'email' => 'required|email|unique:bookings,email',
        'booking_date' => 'required|date|before_or_equal:today',
        'service_type' => 'required|string',
        'status' => 'required|string',
    ]);

    $booking = Booking::create($validated);

    // send email confirmation
    Mail::to($booking->email)->send(new BookingConfirmation($booking));

    if($request->expectsJson()){
        return response()->json(['success' => true, 'booking' => $booking]);
    }

    return redirect()->route('bookings.index')->with('success', 'Booking created and confirmation email sent!');
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


   public function destroy(Request $request, Booking $booking)
{
    $booking->delete();

    // If AJAX request, return JSON
    if($request->expectsJson()){
        return response()->json(['success' => true]);
    }

    return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
}

}
