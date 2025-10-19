@extends('layouts.app')

@section('content')
<h1>Add Booking</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="customer_name" class="form-label">Customer Name</label>
        <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ old('customer_name') }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
    </div>

    <div class="mb-3">
        <label for="booking_date" class="form-label">Booking Date</label>
        <input type="date" class="form-control" name="booking_date" id="booking_date" value="{{ old('booking_date') }}">
    </div>

    <div class="mb-3">
        <label for="service_type" class="form-label">Service Type</label>
        <select class="form-control" name="service_type" id="service_type">
            <option value="Transport">Transport</option>
            <option value="Meeting">Meeting</option>
            <option value="Event">Event</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" name="status" id="status">
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Add Booking</button>
</form>
@endsection
