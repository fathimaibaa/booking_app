@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-3 align-items-center">
        <div class="col-md-4 mb-2 mb-md-0">
            <h2 style="color:#6d4c41;">All Bookings</h2>
        </div>

        <div class="col-md-5 mb-2 mb-md-0">
            {{-- Search form --}}
            <form method="GET" action="{{ route('bookings.index') }}" class="row g-2">
                <div class="col-12 col-md-4">
                    <input type="text" name="search" class="form-control rounded-4 shadow-sm" placeholder="Search by name, email, or service" value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select rounded-4 shadow-sm">
                        <option value="">All Status</option>
                        <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 d-grid">
                    <button type="submit" class="btn btn-gradient fw-semibold">Filter</button>
                </div>
            </form>
        </div>

        <div class="col-md-3 text-md-end">
            <a href="{{ route('bookings.create') }}" class="btn btn-gradient fw-semibold">Add Booking</a>
        </div>
    </div>

    <div class="card border-2 rounded-5 shadow-lg">
        <div class="card-body p-0">
            <table class="table align-middle text-center mb-0">
                <thead class="text-white" style="background: linear-gradient(135deg, #f7e8e0, #f0d8c0); color:#6d4c41;">
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
                    <tr class="table-row-hover">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->service_type }}</td>
                        <td>
                            <span class="badge status-badge {{ strtolower($booking->status) }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-edit me-1">Edit</a>
                            <form id="delete-form-{{ $booking->id }}" action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-delete" onclick="showConfirm({{ $booking->id }}, '{{ $booking->customer_name }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $bookings->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>

<!-- Custom Confirmation Popup -->
<div id="confirmBox" class="custom-confirm d-none">
    <div class="confirm-content">
        <h5 id="confirmText"></h5>
        <div class="mt-3 text-center">
            <button id="confirmCancel" class="btn btn-cancel me-2">Cancel</button>
            <button id="confirmYes" class="btn btn-confirm">Yes, Delete</button>
        </div>
    </div>
</div>

<style>
body {
    background: #fcf7f3;
    font-family: 'Inter', sans-serif;
}

/* Table Row Hover */
.table-hover tbody tr.table-row-hover:hover {
    background: #fdf0e6;
    transition: 0.3s ease;
}

/* Status Badges */
.status-badge {
    padding: 0.35rem 0.7rem;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.85rem;
}
.status-badge.confirmed { background:#c8e6c9; color:#256029; }
.status-badge.pending { background:#fff3cd; color:#856404; }
.status-badge.cancelled { background:#f8d7da; color:#842029; }

/* Buttons */
.btn-gradient {
    background: linear-gradient(135deg, #f2bfa5, #e88f6a);
    border: none;
    color: #ffffff;
    border-radius: 14px;
    transition: all 0.3s ease;
}
.btn-gradient:hover {
    background: linear-gradient(135deg, #e88f6a, #f2bfa5);
}

.btn-edit {
    background: #f0e0d6;
    color: #6d4c41;
    border-radius: 10px;
    transition: 0.3s ease;
}
.btn-edit:hover {
    background: #e5d2c3;
}

.btn-delete {
    background: #f7d8d8;
    color: #842029;
    border-radius: 10px;
}
.btn-delete:hover {
    background: #f28c8c;
    color: #611a1a;
}

/* Confirmation Popup */
.custom-confirm {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
}
.confirm-content {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(8px);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    width: 350px;
    text-align: center;
}

.btn-cancel {
    background: #e0e0e0;
    color: #4e342e;
    border-radius: 10px;
}
.btn-cancel:hover {
    background: #d5d5d5;
}

.btn-confirm {
    background: #f7b4b4;
    color: #842029;
    border-radius: 10px;
}
.btn-confirm:hover {
    background: #f28c8c;
    color: #611a1a;
}
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
    if(selectedId) {
        document.getElementById(`delete-form-${selectedId}`).submit();
    }
});
</script>
@endsection
