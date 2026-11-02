
@extends('layouts.app')

@section('content')

<style>
    .admin-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 35px 0 55px;
        font-family: 'Nunito', sans-serif;
    }

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 28px;
    }

    .page-heading h2 {
        color: #102448;
        font-size: 27px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .page-heading p {
        color: #8792a5;
        font-size: 14px;
        margin: 0;
    }

    .admin-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: all .2s ease;
    }

    .admin-btn-primary {
        color: white;
        background: linear-gradient(110deg, #7771ee, #625bd0);
        border: none;
    }

    .admin-btn-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 7px 16px rgba(111,104,220,.22);
    }

    .admin-btn-outline {
        color: #716be0;
        background: white;
        border: 1px solid #dcdafe;
    }

    .admin-btn-outline:hover {
        color: #625bd0;
        background: #f4f3ff;
    }

    .doctors-stat-card {
        background: white;
        border: none;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-label {
        color: #8792a5;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .stat-number {
        color: #102448;
        font-size: 30px;
        font-weight: 800;
        margin: 0;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f0efff;
        color: #716be0;
        font-size: 22px;
    }

    .doctors-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        overflow: hidden;
    }

    .doctors-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #edf0f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .doctors-card-header h4 {
        color: #102448;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
    }

    .count-badge {
        color: #716be0;
        background: #f0efff;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 800;
    }

    .doctors-table {
        margin: 0;
        min-width: 850px;
    }

    .doctors-table thead th {
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

    .doctors-table tbody td {
        padding: 16px 18px;
        color: #42516a;
        font-size: 13px;
        border-bottom: 1px solid #f0f2f7;
        vertical-align: middle;
    }

    .doctors-table tbody tr:last-child td {
        border-bottom: none;
    }

    .doctors-table tbody tr:hover {
        background: #fafaff;
    }

    .doctor-name {
        color: #102448;
        font-weight: 800;
    }

    .doctor-specialty {
        color: #716be0;
        font-weight: 700;
    }

    .doctor-status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-available {
        color: #25875b;
        background: #e7f7ef;
    }

    .status-unavailable {
        color: #d34f55;
        background: #fff0f0;
    }

    .table-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: none;
        border-radius: 7px;
        padding: 7px 10px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
        text-decoration: none;
        transition: all .2s ease;
        cursor: pointer;
    }

    .edit-btn {
        color: #625bd0;
        background: #f0efff;
    }

    .edit-btn:hover {
        color: white;
        background: #716be0;
    }

    .delete-btn {
        color: #d34f55;
        background: #fff0f0;
    }

    .delete-btn:hover {
        color: white;
        background: #d34f55;
    }

    .available-btn {
        color: #25875b;
        background: #e7f7ef;
    }

    .available-btn:hover {
        color: white;
        background: #25875b;
    }

    .unavailable-btn {
        color: #c58a23;
        background: #fff4df;
    }

    .unavailable-btn:hover {
        color: white;
        background: #c58a23;
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
        margin-bottom: 20px;
    }

    @media (max-width: 576px) {
        .admin-page {
            padding-top: 25px;
        }

        .page-heading h2 {
            font-size: 23px;
        }

        .doctors-card-header {
            padding: 18px;
        }
    }
</style>

<div class="admin-page">
    <div class="container">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-heading">
            <div>
                <h2>Manage Doctors</h2>
                <p>Manage your clinic doctors and their availability.</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.doctors.create') }}"
                   class="admin-btn admin-btn-primary">
                    <i class="fas fa-plus"></i>
                    Add New Doctor
                </a>

                <a href="{{ route('admin.dashboard') }}"
                   class="admin-btn admin-btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Dashboard
                </a>
            </div>
        </div>

        {{-- Doctors Statistics --}}
        <div class="doctors-stat-card">
            <div>
                <div class="stat-label">Total Doctors</div>
                <h3 class="stat-number">{{ $doctors->count() }}</h3>
            </div>

            <div class="stat-icon">
                <i class="fas fa-user-doctor"></i>
            </div>
        </div>

        {{-- Doctors Table --}}
        <div class="doctors-card">

            <div class="doctors-card-header">
                <h4>
                    <i class="fas fa-user-doctor me-2" style="color:#7771ee;"></i>
                    All Doctors
                </h4>

                <span class="count-badge">
                    {{ $doctors->count() }} Doctors
                </span>
            </div>

            @if($doctors->isEmpty())

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-user-doctor"></i>
                    </div>

                    <h5>No Doctors Found</h5>
                    <p>Start by adding a doctor to your clinic.</p>

                    <a href="{{ route('admin.doctors.create') }}"
                       class="admin-btn admin-btn-primary">
                        <i class="fas fa-plus"></i>
                        Add New Doctor
                    </a>
                </div>

            @else

                <div class="table-responsive">
                    <table class="table doctors-table align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor Name</th>
                                <th>Specialty</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="doctor-name">
                                            {{ $doctor->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="doctor-specialty">
                                            {{ $doctor->specialty->name ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td>{{ $doctor->email ?? 'N/A' }}</td>

                                    <td>{{ $doctor->phone ?? 'N/A' }}</td>

                                    {{-- Doctor Status --}}
                                    <td>
                                        @if($doctor->is_available)
                                            <span class="doctor-status status-available">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Available
                                            </span>
                                        @else
                                            <span class="doctor-status status-unavailable">
                                                <i class="fas fa-ban me-1"></i>
                                                Unavailable
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="table-actions">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                               class="action-btn edit-btn">
                                                <i class="fas fa-pen"></i>
                                                Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('admin.doctors.destroy', $doctor->id) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this doctor?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-btn delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>

                                            {{-- Availability --}}
                                            <form
                                                action="{{ route('admin.doctors.toggleAvailability', $doctor->id) }}"
                                                method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('PATCH')

                                                @if($doctor->is_available)
                                                    <button type="submit" class="action-btn unavailable-btn">
                                                        <i class="fas fa-ban"></i>
                                                        Make Unavailable
                                                    </button>
                                                @else
                                                    <button type="submit" class="action-btn available-btn">
                                                        <i class="fas fa-check"></i>
                                                        Make Available
                                                    </button>
                                                @endif

                                            </form>

                                        </div>
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
