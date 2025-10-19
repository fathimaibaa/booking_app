@extends('layouts.app')

@section('content')
<h2>Edit Booking</h2>
<form action="{{ route('bookings.update', $booking->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $booking->email }}" required>
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="booking_date" class="form-control" value="{{ $booking->booking_date }}" required>
    </div>

    <div class="mb-3">
        <label>Service</label>
        <select name="service_type" class="form-control" required>
            <option value="Transport" {{ $booking->service_type == 'Transport' ? 'selected' : '' }}>Transport</option>
            <option value="Meeting" {{ $booking->service_type == 'Meeting' ? 'selected' : '' }}>Meeting</option>
            <option value="Event" {{ $booking->service_type == 'Event' ? 'selected' : '' }}>Event</option>
            </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
