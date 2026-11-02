
@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f5f7fc;
    }

    .dashboard-wrapper {
        padding: 35px 0 60px;
    }

    /* Welcome Section */
    .welcome-card {
        position: relative;
        overflow: hidden;
        background: linear-gradient(115deg, #07142f, #163c68);
        color: white;
        border-radius: 22px;
        padding: 48px;
        margin-bottom: 42px;
        box-shadow: 0 12px 35px rgba(7, 20, 47, 0.15);
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        border: 45px solid rgba(255,255,255,0.04);
        border-radius: 50%;
        right: -70px;
        top: -130px;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        background: rgba(119, 114, 255, 0.12);
        border-radius: 50%;
        right: 140px;
        bottom: -120px;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
    }

    .welcome-label {
        display: inline-block;
        background: rgba(255,255,255,0.12);
        color: #b9c7ff;
        padding: 7px 15px;
        border-radius: 30px;
        font-size: 13px;
        margin-bottom: 18px;
        letter-spacing: 0.5px;
    }

    .welcome-card h2 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .welcome-card p {
        color: #d2dced;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 27px;
    }

    .main-btn {
        display: inline-block;
        background: #817bff;
        color: white;
        border: none;
        padding: 13px 23px;
        border-radius: 10px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .main-btn:hover {
        background: #6a64e8;
        color: white;
        transform: translateY(-2px);
    }

    .welcome-decoration {
        position: absolute;
        right: 8%;
        top: 50%;
        transform: translateY(-50%);
        font-size: 130px;
        color: rgba(255,255,255,0.10);
    }

    /* Section Headings */
    .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #102b50;
        margin-bottom: 8px;
    }

    .section-subtitle {
        color: #8994a8;
        font-size: 14px;
        margin-bottom: 25px;
    }

    /* Dashboard Cards */
    .dashboard-card {
        display: block;
        position: relative;
        overflow: hidden;
        background: white;
        border: 1px solid #edf0f7;
        border-radius: 18px;
        padding: 27px;
        height: 100%;
        text-decoration: none;
        box-shadow: 0 5px 20px rgba(20, 40, 80, 0.04);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 14px 30px rgba(20, 40, 80, 0.09);
        border-color: #dcdcff;
    }

    .card-icon {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eeefff;
        color: #716cf0;
        border-radius: 15px;
        font-size: 23px;
        margin-bottom: 22px;
    }

    .dashboard-card h5 {
        font-size: 17px;
        font-weight: 800;
        color: #102b50;
        margin-bottom: 10px;
    }

    .dashboard-card p {
        color: #8994a8;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .card-arrow {
        color: #7772ff;
        font-size: 14px;
        font-weight: 700;
    }

    /* Quick Actions */
    .quick-link {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 20px;
        border-radius: 15px;
        background: white;
        border: 1px solid #edf0f7;
        text-decoration: none;
        color: #102b50;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(20, 40, 80, 0.03);
        transition: 0.3s;
    }

    .quick-link:hover {
        transform: translateX(5px);
        border-color: #dcdcff;
        color: #716cf0;
        box-shadow: 0 8px 20px rgba(20, 40, 80, 0.07);
    }

    .quick-icon {
        min-width: 48px;
        height: 48px;
        background: #eeefff;
        color: #716cf0;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .quick-link h6 {
        font-weight: 800;
        color: #102b50;
    }

    .quick-link small {
        color: #8994a8;
    }

    /* Alerts */
    .dashboard-alert {
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
    }

    @media (max-width: 768px) {
        .welcome-card {
            padding: 30px 23px;
        }

        .welcome-card h2 {
            font-size: 26px;
        }

        .welcome-decoration {
            display: none;
        }
    }
</style>

<div class="container dashboard-wrapper">

    {{-- Status Messages --}}
    @if (session('status'))
        <div class="alert alert-success dashboard-alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success dashboard-alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Welcome Section --}}
    <div class="welcome-card">

        <div class="welcome-content">

            <span class="welcome-label">
                <i class="fas fa-heartbeat me-2"></i>
                YOUR HEALTH, OUR PRIORITY
            </span>

            <h2>
                Welcome back, {{ Auth::user()->name }}!
            </h2>

            <p>
                Take care of your health with MediCare.
                Find the right doctor, book your appointments,
                and manage your medical visits easily.
            </p>

            <a href="{{ route('appointments.create') }}" class="main-btn">
                <i class="fas fa-calendar-plus me-2"></i>
                Book an Appointment
                <i class="fas fa-arrow-right ms-2"></i>
            </a>

        </div>

        <div class="welcome-decoration">
            <i class="fas fa-heartbeat"></i>
        </div>

    </div>

    {{-- Dashboard Section --}}
    <div class="mb-4">

        <h4 class="section-title">Your Dashboard</h4>

        <p class="section-subtitle">
            Everything you need to manage your healthcare in one place.
        </p>

    </div>

    <div class="row g-4 mb-5">

        {{-- My Appointments --}}
        <div class="col-md-4">

            <a href="{{ route('appointments.index') }}" class="dashboard-card">

                <div class="card-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <h5>My Appointments</h5>

                <p>
                    View and manage your upcoming appointments
                    with your doctors.
                </p>

                <span class="card-arrow">
                    View Appointments
                    <i class="fas fa-arrow-right ms-1"></i>
                </span>

            </a>

        </div>

        {{-- Find a Doctor --}}
        <div class="col-md-4">

            <a href="{{ route('appointments.create') }}" class="dashboard-card">

                <div class="card-icon">
                    <i class="fas fa-user-md"></i>
                </div>

                <h5>Find a Doctor</h5>

                <p>
                    Explore available doctors and discover
                    their medical specialties.
                </p>

                <span class="card-arrow">
                    Find Doctors
                    <i class="fas fa-arrow-right ms-1"></i>
                </span>

            </a>

        </div>

        {{-- Appointment History --}}
        <div class="col-md-4">

            <a href="{{ route('appointments.index') }}" class="dashboard-card">

                <div class="card-icon">
                    <i class="fas fa-file-medical-alt"></i>
                </div>

                <h5>Appointment History</h5>

                <p>
                    Keep track of your previous clinic visits
                    and booking history.
                </p>

                <span class="card-arrow">
                    View History
                    <i class="fas fa-arrow-right ms-1"></i>
                </span>

            </a>

        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="mb-4">

        <h4 class="section-title">Quick Actions</h4>

        <p class="section-subtitle">
            Get started with your healthcare journey.
        </p>

    </div>

    <div class="row">

        <div class="col-md-6">

            <a href="{{ route('appointments.create') }}" class="quick-link">

                <div class="quick-icon">
                    <i class="fas fa-plus"></i>
                </div>

                <div>
                    <h6 class="mb-1">Book a New Appointment</h6>

                    <small>
                        Choose your doctor and preferred time.
                    </small>
                </div>

                <i class="fas fa-chevron-right ms-auto"></i>

            </a>

        </div>

        <div class="col-md-6">

            <a href="{{ route('appointments.index') }}" class="quick-link">

                <div class="quick-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>

                <div>
                    <h6 class="mb-1">View My Appointments</h6>

                    <small>
                        Check your appointment history.
                    </small>
                </div>

                <i class="fas fa-chevron-right ms-auto"></i>

            </a>

        </div>

    </div>

</div>

@endsection

