<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        margin: 0;
        padding: 0;
    }

    /* CSS-only auto-hide alert */
    .auto-hide {
        animation: fadeOut 3s ease-in-out forwards;
    }

    @keyframes fadeOut {
        0% { opacity: 1; max-height: 100px; margin: 1rem 0; padding: 0.75rem 1.25rem; }
        70% { opacity: 1; max-height: 100px; }
        100% { opacity: 0; max-height: 0; margin: 0; padding: 0; }
    }

    .alert {
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
</style>

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('bookings.index') }}">Booking System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">{{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-link nav-link text-white">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <!-- Flash success message -->
        @if (session('success'))
            <div class="alert alert-success auto-hide" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main content -->
        @yield('content')
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
