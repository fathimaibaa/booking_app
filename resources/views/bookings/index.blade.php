@extends('layouts.app')

@section('content')
<div class="mb-3">
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>
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
                <span class="badge bg-success">{{ $booking->status }}</span>
            </td>
            <td>
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="showConfirm({{ $booking->id }}, '{{ $booking->customer_name }}')">
                    Delete
                </button>

                <form id="delete-form-{{ $booking->id }}" action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

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
