
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

    .profile-card {
        background: white;
        border: none;
        border-radius: 16px;
        padding: 23px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        margin: 28px 0;
    }

    .profile-title {
        color: #102448;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .profile-item {
        color: #8792a5;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .profile-value {
        color: #102448;
        font-size: 14px;
        font-weight: 800;
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

    .appointments-table {
        margin: 0;
        min-width: 800px;
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

        {{-- Dashboard Header --}}
        <div class="dashboard-heading">
            <div>
                <h2>Doctor Dashboard</h2>
                <p>Welcome back, Dr. {{ $doctor->name }}! Here's your clinic overview.</p>
            </div>

            <span class="admin-badge">
                <i class="fas fa-user-doctor me-2"></i>
                Doctor
            </span>
        </div>

        {{-- Statistics --}}
        <div class="row g-3">

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Total Appointments</div>
                            <h3 class="stat-number">{{ $appointments->count() }}</h3>
                        </div>
                        <div class="stat-icon icon-purple">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Pending Appointments</div>
                            <h3 class="stat-number">
                                {{ $appointments->where('status', 'pending')->count() }}
                            </h3>
                        </div>
                        <div class="stat-icon icon-orange">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="dashboard-stat">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Confirmed Appointments</div>
                            <h3 class="stat-number">
                                {{ $appointments->where('status', 'confirmed')->count() }}
                            </h3>
                        </div>
                        <div class="stat-icon icon-green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Doctor Profile --}}
        <div class="profile-card">

            <h5 class="profile-title">
                <i class="fas fa-user-md me-2" style="color:#7771ee;"></i>
                My Profile
            </h5>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="profile-item">Doctor Name</div>
                    <div class="profile-value">{{ $doctor->name }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="profile-item">Email Address</div>
                    <div class="profile-value">{{ $doctor->email ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="profile-item">Phone Number</div>
                    <div class="profile-value">{{ $doctor->phone ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="profile-item">Specialty</div>
                    <div class="profile-value">
                        {{ optional($doctor->specialty)->name ?? '-' }}
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="profile-item">Working Hours</div>
                    <div class="profile-value">
                        {{ $doctor->start_time ? \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') : '-' }}
                        -
                        {{ $doctor->end_time ? \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') : '-' }}
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="profile-item">Availability</div>
                    <div class="profile-value">
                        @if($doctor->is_available)
                            <span class="status-badge status-confirmed">Available</span>
                        @else
                            <span class="status-badge status-cancelled">Unavailable</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- Appointments Table --}}
        <div class="appointments-card">

            <div class="appointments-header">
                <h4>
                    <i class="fas fa-calendar-days me-2" style="color:#7771ee;"></i>
                    My Appointments
                </h4>

                <span class="appointments-count">
                    {{ $appointments->count() }} Appointments
                </span>
            </div>

            @if($appointments->isEmpty())

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-calendar-xmark"></i>
                    </div>

                    <h5>No Appointments Yet</h5>
                    <p>Your appointments will appear here when patients book with you.</p>
                </div>

            @else

                <div class="table-responsive">
                    <table class="table appointments-table align-middle">

                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Notes</th>
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
                                        {{ optional($appointment->patient)->email ?? '-' }}
                                    </td>

                                    <td>
                                        <i class="far fa-calendar me-1 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                    </td>

                                    <td>
                                        <i class="far fa-clock me-1 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </td>

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

                                    <td>
                                        {{ $appointment->notes ?: '-' }}
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

