@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Elegant Card -->
            <div class="card border-2 rounded-5 shadow-lg" style="background: #ffffff; border-color: #d7bfae;">
                <div class="card-header text-center border-0 rounded-top-5" style="background: #fdf6f0;">
                    <h2 class="mb-0 fw-bold" style="color: #6d4c41;">Add New Booking</h2>
                </div>

                <div class="card-body p-5">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-medium">Customer Name</label>
                            <input type="text" class="form-control rounded-4 shadow-sm" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter your name" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control rounded-4 shadow-sm" name="email" value="{{ old('email') }}" placeholder="yourname@example.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Booking Date</label>
                            <input type="date" class="form-control rounded-4 shadow-sm" name="booking_date" value="{{ old('booking_date') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Service Type</label>
                            <select class="form-select rounded-4 shadow-sm" name="service_type" required>
                                <option value="Transport" {{ old('service_type') == 'Transport' ? 'selected' : '' }}>Transport</option>
                                <option value="Meeting" {{ old('service_type') == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                                <option value="Event" {{ old('service_type') == 'Event' ? 'selected' : '' }}>Event</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Status</label>
                            <select class="form-select rounded-4 shadow-sm" name="status" required>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-gradient btn-lg fw-semibold">Add Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: #fcf7f3;
    font-family: 'Inter', sans-serif;
}

/* Card Style */
.card {
    border-width: 2px !important;
    border-color: #d7bfae !important;
    border-radius: 1.5rem;
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.12);
}

/* Input Fields */
.form-control, .form-select {
    border: 1px solid #e0dcdc;
    background: #fcfaf8;
    color: #5a4d4b;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.03);
}
.form-control::placeholder {
    color: #b7a89b;
}
.form-control:focus, .form-select:focus {
    border-color: #cfa188;
    box-shadow: 0 0 0 0.2rem rgba(207,161,136,0.2), inset 0 1px 3px rgba(0,0,0,0.05);
    background: #fff;
}

/* Labels */
.form-label {
    color: #5a4d4b;
    font-size: 0.95rem;
}

/* Gradient Button */
.btn-gradient {
    background: linear-gradient(135deg, #f2bfa5, #e88f6a);
    border: none;
    color: #ffffff;
    border-radius: 14px;
    transition: 0.3s ease;
}
.btn-gradient:hover {
    background: linear-gradient(135deg, #e88f6a, #f2bfa5);
    color: #fff;
}

/* Alerts rounded */
.alert {
    font-size: 0.9rem;
}
</style>
@endsection
