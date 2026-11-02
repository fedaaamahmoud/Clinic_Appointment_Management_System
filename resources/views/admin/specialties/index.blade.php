

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

    .specialties-stat-card {
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

    .specialties-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        overflow: hidden;
    }

    .specialties-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #edf0f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .specialties-card-header h4 {
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

    .specialties-table {
        margin: 0;
        min-width: 650px;
    }

    .specialties-table thead th {
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

    .specialties-table tbody td {
        padding: 17px 18px;
        color: #42516a;
        font-size: 13px;
        border-bottom: 1px solid #f0f2f7;
        vertical-align: middle;
    }

    .specialties-table tbody tr:last-child td {
        border-bottom: none;
    }

    .specialties-table tbody tr:hover {
        background: #fafaff;
    }

    .specialty-name {
        color: #102448;
        font-weight: 800;
    }

    .specialty-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #f0efff;
        color: #716be0;
        margin-right: 9px;
    }

    .description-text {
        color: #77839a;
        max-width: 280px;
        line-height: 1.6;
    }

    .doctor-count {
        display: inline-block;
        background: #eaf3ff;
        color: #397acb;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 800;
    }

    .table-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: none;
        border-radius: 7px;
        padding: 7px 11px;
        font-size: 11px;
        font-weight: 800;
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

        .specialties-card-header {
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
                <h2>Manage Specialties</h2>
                <p>Organize and manage the medical specialties in your clinic.</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.specialties.create') }}"
                   class="admin-btn admin-btn-primary">
                    <i class="fas fa-plus"></i>
                    Add New Specialty
                </a>

                <a href="{{ route('admin.dashboard') }}"
                   class="admin-btn admin-btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Dashboard
                </a>
            </div>
        </div>

        {{-- Statistics --}}
        <div class="specialties-stat-card">
            <div>
                <div class="stat-label">Total Specialties</div>
                <h3 class="stat-number">{{ $specialties->count() }}</h3>
            </div>

            <div class="stat-icon">
                <i class="fas fa-stethoscope"></i>
            </div>
        </div>

        {{-- Specialties Table --}}
        <div class="specialties-card">

            <div class="specialties-card-header">
                <h4>
                    <i class="fas fa-list-ul me-2" style="color:#7771ee;"></i>
                    Specialties List
                </h4>

                <span class="count-badge">
                    {{ $specialties->count() }} Specialties
                </span>
            </div>

            @if($specialties->isEmpty())

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>

                    <h5>No Specialties Found</h5>
                    <p>Start by adding a medical specialty to your clinic.</p>

                    <a href="{{ route('admin.specialties.create') }}"
                       class="admin-btn admin-btn-primary">
                        <i class="fas fa-plus"></i>
                        Add New Specialty
                    </a>
                </div>

            @else

                <div class="table-responsive">
                    <table class="table specialties-table align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Specialty Name</th>
                                <th>Description</th>
                                <th>Doctors Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($specialties as $specialty)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="specialty-icon">
                                            <i class="fas fa-stethoscope"></i>
                                        </span>

                                        <span class="specialty-name">
                                            {{ $specialty->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="description-text">
                                            {{ $specialty->description ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="doctor-count">
                                            <i class="fas fa-user-doctor me-1"></i>
                                            {{ $specialty->doctors_count }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="table-actions">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.specialties.edit', $specialty->id) }}"
                                               class="action-btn edit-btn">
                                                <i class="fas fa-pen"></i>
                                                Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('admin.specialties.destroy', $specialty->id) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this specialty?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-btn delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
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
