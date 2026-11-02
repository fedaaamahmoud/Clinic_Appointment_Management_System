

@extends('layouts.app')

@section('content')

<style>
    .admin-dashboard {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 35px 0 55px;
        font-family: 'Nunito', sans-serif;
    }

    .dashboard-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 30px;
    }

    .dashboard-heading h2 {
        color: #102448;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .dashboard-heading p {
        color: #8792a5;
        margin: 0;
        font-size: 14px;
    }

    .admin-badge {
        background: #eeedff;
        color: #6e67db;
        border: 1px solid #dfddff;
        border-radius: 30px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 800;
    }

    .dashboard-stat {
        background: white;
        border: none;
        border-radius: 16px;
        padding: 23px;
        height: 100%;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        transition: all .25s ease;
    }

    .dashboard-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(16,36,72,.09);
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
    }

    .icon-purple {
        color: #716be0;
        background: #f0efff;
    }

    .icon-orange {
        color: #e49b32;
        background: #fff5e5;
    }

    .icon-blue {
        color: #397acb;
        background: #eaf3ff;
    }

    .icon-green {
        color: #25966a;
        background: #e8f8f0;
    }

    .stat-label {
        color: #8792a5;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .stat-number {
        color: #102448;
        font-size: 29px;
        font-weight: 800;
        margin: 0;
    }

    .management-card {
        background: white;
        border: none;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        margin: 28px 0;
    }

    .management-title {
        color: #102448;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .management-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: all .2s ease;
    }

    .btn-manage-primary {
        background: linear-gradient(110deg, #7771ee, #625bd0);
        color: white;
        border: 1px solid transparent;
    }

    .btn-manage-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(111,104,220,.2);
    }

    .btn-manage-outline {
        background: white;
        color: #716be0;
        border: 1px solid #dcdafe;
    }

    .btn-manage-outline:hover {
        background: #f4f3ff;
        color: #625bd0;
        transform: translateY(-2px);
    }

    .appointments-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        overflow: hidden;
    }

    .appointments-header {
        padding: 23px 25px;
        border-bottom: 1px solid #edf0f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .appointments-header h4 {
        color: #102448;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
    }

    .appointments-count {
        color: #7771ee;
        background: #f0efff;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 800;
    }

    /* Search and Filters */
    .appointment-filters {
        padding: 22px 25px;
        background: #fff;
        border-bottom: 1px solid #edf0f6;
    }

    .filter-label {
        display: block;
        color: #77839a;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .filter-control {
        width: 100%;
        min-height: 43px;
        border: 1px solid #e3e7f0;
        border-radius: 9px;
        padding: 9px 12px;
        color: #42516a;
        font-size: 13px;
        outline: none;
        background: #fff;
    }

    .filter-control:focus {
        border-color: #7771ee;
        box-shadow: 0 0 0 3px rgba(119, 113, 238, .10);
    }

    .filter-actions {
        display: flex;
        align-items: end;
        gap: 8px;
        height: 100%;
    }

    .filter-submit,
    .filter-reset {
        min-height: 43px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        padding: 9px 16px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s ease;
    }

    .filter-submit {
        background: linear-gradient(110deg, #7771ee, #625bd0);
        color: white;
        border: 1px solid transparent;
    }

    .filter-submit:hover {
        color: white;
        transform: translateY(-2px);
    }

    .filter-reset {
        background: white;
        color: #716be0;
        border: 1px solid #dcdafe;
    }

    .filter-reset:hover {
        background: #f4f3ff;
        color: #625bd0;
    }

    .filter-results {
        color: #8792a5;
        font-size: 12px;
        font-weight: 700;
        padding: 14px 25px;
        background: #fafaff;
        border-bottom: 1px solid #edf0f6;
    }

    .appointments-table {
        margin: 0;
        min-width: 850px;
    }

    .appointments-table thead th {
        background: #f8f9fc;
        color: #77839a;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 16px 18px;
        border-bottom: 1px solid #edf0f6;
        white-space: nowrap;
    }

    .appointments-table tbody td {
        padding: 17px 18px;
        color: #42516a;
        font-size: 13px;
        border-bottom: 1px solid #f0f2f7;
        vertical-align: middle;
    }

    .appointments-table tbody tr:last-child td {
        border-bottom: none;
    }

    .appointments-table tbody tr:hover {
        background: #fafaff;
    }

    .person-name {
        color: #102448;
        font-weight: 800;
    }

    .specialty-name {
        color: #7771ee;
        font-weight: 700;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff4df;
        color: #c58a23;
    }

    .status-confirmed {
        background: #e7f7ef;
        color: #25875b;
    }

    .status-cancelled {
        background: #fff0f0;
        color: #d34f55;
    }

    .status-rejected {
        background: #eef0f4;
        color: #737d8e;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-btn {
        border: none;
        border-radius: 7px;
        padding: 7px 10px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
        transition: all .2s ease;
    }

    .confirm-btn {
        background: #e7f7ef;
        color: #25875b;
    }

    .confirm-btn:hover {
        background: #25875b;
        color: white;
    }

    .reject-btn {
        background: #fff0f0;
        color: #d34f55;
    }

    .reject-btn:hover {
        background: #d34f55;
        color: white;
    }

    .no-actions {
        color: #a0a8b6;
        font-size: 12px;
    }

    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        background: #f0efff;
        color: #7771ee;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        margin: 0 auto 17px;
    }

    .empty-state h5 {
        color: #102448;
        font-weight: 800;
        font-size: 16px;
    }

    .empty-state p {
        color: #929caf;
        font-size: 13px;
        margin: 0;
    }

    @media (max-width: 576px) {
        .admin-dashboard {
            padding-top: 25px;
        }

        .dashboard-heading h2 {
            font-size: 23px;
        }

        .dashboard-stat {
            padding: 18px;
        }

        .stat-number {
            font-size: 25px;
        }

        .appointments-header {
            padding: 18px;
        }

        .appointment-filters {
            padding: 18px;
        }

        .filter-actions {
            align-items: stretch;
        }

        .filter-submit,
        .filter-reset {
            flex: 1;
        }
    }
</style>

<div class="admin-dashboard">
    <div class="container">

        {{-- Success and Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Dashboard Header --}}
        <div class="dashboard-heading">
            <div>
                <h2>Admin Dashboard</h2>
                <p>Welcome back! Here's what's happening in your clinic.</p>
            </div>

            <span class="admin-badge">
                <i class="fas fa-user-shield me-2"></i>
                Administrator
            </span>
        </div>

        {{-- Statistics --}}
        <div class="row g-3">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Total Appointments</div>
                            <h3 class="stat-number">{{ $totalAppointments }}</h3>
                        </div>
                        <div class="stat-icon icon-purple">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Pending Appointments</div>
                            <h3 class="stat-number">{{ $pendingAppointments }}</h3>
                        </div>
                        <div class="stat-icon icon-orange">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Total Doctors</div>
                            <h3 class="stat-number">{{ $totalDoctors }}</h3>
                        </div>
                        <div class="stat-icon icon-blue">
                            <i class="fas fa-user-doctor"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Total Patients</div>
                            <h3 class="stat-number">{{ $totalPatients }}</h3>
                        </div>
                        <div class="stat-icon icon-green">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Management Section --}}
        <div class="management-card">
            <h5 class="management-title">
                <i class="fas fa-sliders me-2" style="color:#7771ee;"></i>
                Quick Management
            </h5>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.doctors.index') }}"
                   class="management-btn btn-manage-primary">
                    <i class="fas fa-user-doctor"></i>
                    Manage Doctors
                </a>

                <a href="{{ route('admin.specialties.index') }}"
                   class="management-btn btn-manage-outline">
                    <i class="fas fa-stethoscope"></i>
                    Manage Specialties
                </a>
            </div>
        </div>

        {{-- Appointments Table --}}
        <div class="appointments-card">

            <div class="appointments-header">
                <h4>
                    <i class="fas fa-calendar-days me-2" style="color:#7771ee;"></i>
                    All Appointments
                </h4>

                <span class="appointments-count">
                    {{ $appointments->count() }} Appointments
                </span>
            </div>

            {{-- Search and Filters --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" class="appointment-filters">
                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="filter-label">Search</label>
                        <input
                            type="text"
                            name="search"
                            class="filter-control"
                            placeholder="Patient, doctor, or email..."
                            value="{{ request('search') }}"
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="filter-label">Status</label>
                        <select name="status" class="filter-control">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="filter-label">Date From</label>
                        <input
                            type="date"
                            name="date_from"
                            class="filter-control"
                            value="{{ request('date_from') }}"
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="filter-label">Date To</label>
                        <input
                            type="date"
                            name="date_to"
                            class="filter-control"
                            value="{{ request('date_to') }}"
                            min="{{ request('date_from') }}"
                        >
                    </div>

                    <div class="col-12 col-lg-2">
                        <div class="filter-actions">
                            <button type="submit" class="filter-submit">
                                <i class="fas fa-search"></i>
                                Search
                            </button>

                            <a href="{{ route('admin.dashboard') }}" class="filter-reset">
                                <i class="fas fa-rotate-left"></i>
                                Reset
                            </a>
                        </div>
                    </div>

                </div>
            </form>

            <div class="filter-results">
                <i class="fas fa-filter me-1" style="color:#7771ee;"></i>
                Showing {{ $appointments->count() }} matching appointment(s)
            </div>

            @if($appointments->isEmpty())

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-calendar-xmark"></i>
                    </div>

                    <h5>No Appointments Found</h5>
                    <p>
                        @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                            Try changing your search or filters.
                        @else
                            Appointments will appear here when patients make bookings.
                        @endif
                    </p>
                </div>

            @else

                <div class="table-responsive">
                    <table class="table appointments-table align-middle">

                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Specialty</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($appointments as $appointment)

                                <tr>
                                    <td>
                                        <span class="person-name">
                                            {{ optional($appointment->patient)->name ?? 'Unknown' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="person-name">
                                            {{ optional($appointment->doctor)->name ?? 'Unknown' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="specialty-name">
                                            {{ optional(optional($appointment->doctor)->specialty)->name ?? 'Unknown' }}
                                        </span>
                                    </td>

                                    <td>
                                        <i class="far fa-calendar me-1 text-muted"></i>
                                        {{ $appointment->appointment_date }}
                                    </td>

                                    <td>
                                        <i class="far fa-clock me-1 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if($appointment->status === 'pending')
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-hourglass-half me-1"></i>
                                                Pending
                                            </span>

                                        @elseif($appointment->status === 'confirmed')
                                            <span class="status-badge status-confirmed">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Confirmed
                                            </span>

                                        @elseif($appointment->status === 'cancelled')
                                            <span class="status-badge status-cancelled">
                                                <i class="fas fa-ban me-1"></i>
                                                Cancelled
                                            </span>

                                        @elseif($appointment->status === 'rejected')
                                            <span class="status-badge status-rejected">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Rejected
                                            </span>

                                        @else
                                            <span class="status-badge status-rejected">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        @if($appointment->status === 'pending')

                                            <div class="action-buttons">

                                                {{-- Confirm --}}
                                                <form
                                                    action="{{ route('admin.appointments.updateStatus', $appointment->id) }}?{{ http_build_query(request()->only(['search', 'status', 'date_from', 'date_to'])) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="confirmed">

                                                    <button type="submit" class="action-btn confirm-btn">
                                                        <i class="fas fa-check me-1"></i>
                                                        Confirm
                                                    </button>
                                                </form>

                                                {{-- Reject --}}
                                                <form
                                                    action="{{ route('admin.appointments.updateStatus', $appointment->id) }}?{{ http_build_query(request()->only(['search', 'status', 'date_from', 'date_to'])) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to reject this appointment?')">

                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="rejected">

                                                    <button type="submit" class="action-btn reject-btn">
                                                        <i class="fas fa-times me-1"></i>
                                                        Reject
                                                    </button>
                                                </form>

                                            </div>

                                        @else

                                            <span class="no-actions">No actions</span>

                                        @endif
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>

            @endif

        </div>

    </div>
</div>

@endsection
