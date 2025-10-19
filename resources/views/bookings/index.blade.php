@extends('layouts.app')

@section('content')
<div class="mb-3">
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Service</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $booking->customer_name }}</td>
            <td>{{ $booking->email }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->service_type }}</td>
            <td>{{ $booking->status }}</td>
            <td>
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
