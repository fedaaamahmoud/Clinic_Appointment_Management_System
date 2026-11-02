
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MediCare | Clinic Appointment System</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f7f9fd;
        }

        /* Navbar */
        .medicare-navbar {
            background: linear-gradient(110deg, #07142f, #102b50);
            padding: 15px 25px;
            min-height: 85px;
            box-shadow: 0 5px 20px rgba(10, 30, 65, 0.15);
        }

        .medicare-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white !important;
            font-size: 27px;
            font-weight: 800;
            line-height: 1.1;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border: 2px solid #7772ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #817bff;
            font-size: 25px;
        }

        .brand-highlight {
            color: #7772ff;
        }

        .medicare-brand small {
            display: block;
            font-size: 11px;
            font-weight: 400;
            color: #c6d2e5;
            margin-top: 5px;
        }

        .medicare-links {
            gap: 15px;
        }

        .medicare-navbar .nav-link {
            color: #e4eaf5 !important;
            font-size: 15px;
            font-weight: 600;
            padding: 12px 14px !important;
            transition: 0.3s;
        }

        .medicare-navbar .nav-link:hover {
            color: #8580ff !important;
        }

        .medicare-user {
            align-items: center;
            gap: 12px;
        }

        .notification-link {
            position: relative;
            font-size: 20px !important;
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-count {
            position: absolute;
            top: 0;
            right: -5px;
            background: #ef334f;
            color: white;
            font-size: 11px;
            font-weight: bold;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-link {
            font-size: 16px !important;
        }

        .medicare-navbar .dropdown-menu {
            border: none;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .medicare-navbar .dropdown-item {
            padding: 10px 14px;
            border-radius: 8px;
        }

        main {
            min-height: 80vh;
        }

        @media (max-width: 991px) {
            .medicare-links {
                margin-top: 15px;
            }

            .medicare-user {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg medicare-navbar">
            <div class="container-fluid px-lg-4">

                <!-- Brand -->
                <a class="navbar-brand medicare-brand" href="{{ url('/') }}">
                    <span class="brand-icon">
                        <i class="fas fa-heartbeat"></i>
                    </span>

                    <span>
                        Medi<span class="brand-highlight">Care</span>
                        <small>Smart Clinic Appointments</small>
                    </span>
                </a>

                <!-- Mobile Button -->
                <button class="navbar-toggler text-white" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @auth

                        <!-- Navigation Links -->
                        <ul class="navbar-nav mx-auto medicare-links">

                            @if(Auth::user()->role === 'patient')

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <i class="fas fa-home me-1"></i> Home
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('appointments.create') }}">
                                        <i class="fas fa-user-md me-1"></i> Doctors
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('appointments.index') }}">
                                        <i class="far fa-calendar-alt me-1"></i> Appointments
                                    </a>
                                </li>

                            @else

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-chart-line me-1"></i> Dashboard
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.doctors.index') }}">
                                        <i class="fas fa-user-md me-1"></i> Doctors
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.specialties.index') }}">
                                        <i class="fas fa-stethoscope me-1"></i> Specialties
                                    </a>
                                </li>

                            @endif

                        </ul>

                        <!-- User & Notifications -->
                        <ul class="navbar-nav ms-auto medicare-user">

                            @if(Auth::user()->role === 'patient')

                                <li class="nav-item">
                                    <a class="nav-link notification-link"
                                        href="{{ route('notifications.index') }}"
                                        title="Notifications">

                                        <i class="fas fa-bell"></i>

                                        @if(Auth::user()->unreadNotifications->count() > 0)
                                            <span class="notification-count">
                                                {{ Auth::user()->unreadNotifications->count() }}
                                            </span>
                                        @endif

                                    </a>
                                </li>

                            @endif

                            <li class="nav-item dropdown">

                                <a class="nav-link dropdown-toggle user-link"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">

                                    <i class="fas fa-user-circle me-1"></i>
                                    {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <a class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">

                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Logout

                                    </a>

                                    <form id="logout-form"
                                        action="{{ route('logout') }}"
                                        method="POST"
                                        class="d-none">

                                        @csrf

                                    </form>

                                </div>
                            </li>

                        </ul>

                    @else

                        <!-- Guest Links -->
                        <ul class="navbar-nav ms-auto medicare-user">

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    Login
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    Register
                                </a>
                            </li>

                        </ul>

                    @endauth

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>

</html>

