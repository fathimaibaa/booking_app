@extends('layouts.app')

@section('content')
<div class="row mb-3 align-items-center">
    <div class="col-md-4 mb-2 mb-md-0">
        <h2>All Bookings</h2>
    </div>

    <div class="col-md-5 mb-2 mb-md-0">
        {{-- Search form --}}
        <form method="GET" action="{{ route('bookings.index') }}" class="row g-2 align-items-end">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or service" value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
    <div class="col-md-2">
        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
    </div>
    <div class="col-md-2">
        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
    </div>
    <div class="col-md-1 d-grid">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

    </div>

    <div class="col-md-3 text-md-end">
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>
    </div>
</div>


<table class="table table-hover align-middle text-center">
    <thead class="table-dark">
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
            <td>
                        <span class="badge 
                            @if($booking->status == 'Confirmed') bg-success
                            @elseif($booking->status == 'Pending') bg-warning text-dark
                            @else bg-danger
                            @endif">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline delete-form" data-name="{{ $booking->customer_name }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $bookings->withQueryString()->links('pagination::bootstrap-5') }}
</div>



<!-- Custom Confirmation Popup -->
<div id="confirmBox" class="custom-confirm d-none">
    <div class="confirm-content">
        <h5 id="confirmText"></h5>
        <div class="mt-3 text-center">
            <button id="confirmCancel" class="btn btn-secondary me-2">Cancel</button>
            <button id="confirmYes" class="btn btn-danger">Yes, Delete</button>
        </div>
    </div>
</div>

<style>
.custom-confirm {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
}
.confirm-content {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    width: 320px;
    text-align: center;
}
.d-none { display: none !important; }
</style>

<script>
let selectedId = null;

function showConfirm(id, name) {
    selectedId = id;
    document.getElementById('confirmText').innerHTML = `Delete booking for <b>${name}</b>?`;
    document.getElementById('confirmBox').classList.remove('d-none');
}

document.getElementById('confirmCancel').addEventListener('click', () => {
    document.getElementById('confirmBox').classList.add('d-none');
});

document.getElementById('confirmYes').addEventListener('click', () => {
    document.getElementById(`delete-form-${selectedId}`).submit();
});
</script>
@endsection
