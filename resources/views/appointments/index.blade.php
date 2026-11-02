
@extends('layouts.app')

@section('content')

<style>
    .appointments-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 50px 15px;
        font-family: 'Nunito', sans-serif;
    }

    .appointments-wrapper {
        max-width: 1200px;
        margin: auto;
    }

    .appointments-heading h2 {
        color: #102448;
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .appointments-heading p {
        color: #8792a5;
        margin-bottom: 0;
        font-size: 15px;
    }

    .btn-book {
        background: linear-gradient(110deg, #7771ee, #625bd0);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 800;
        font-size: 14px;
        text-decoration: none;
        transition: all .25s ease;
        box-shadow: 0 5px 15px rgba(111, 104, 220, .2);
    }

    .btn-book:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(111, 104, 220, .3);
    }

    .appointments-card {
        background: white;
        border: none;
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(16, 36, 72, .06);
        overflow: hidden;
    }

    .appointments-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .appointments-card-header h5 {
        color: #172c4e;
        font-weight: 800;
        margin: 0;
    }

    .appointments-count {
        background: #f0efff;
        color: #6e67d9;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 800;
    }

    .appointments-table {
        margin: 0;
        min-width: 1000px;
    }

    .appointments-table thead th {
        background: #f8f9fc;
        color: #78849a;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 17px 20px;
        border: none;
        white-space: nowrap;
    }

    .appointments-table tbody td {
        padding: 18px 20px;
        color: #43516a;
        font-size: 14px;
        border-color: #f0f2f7;
        vertical-align: middle;
    }

    .appointments-table tbody tr {
        transition: background .2s ease;
    }

    .appointments-table tbody tr:hover {
        background: #fafaff;
    }

    .doctor-name {
        color: #172c4e;
        font-weight: 800;
    }

    .specialty-name {
        color: #77839a;
        font-size: 13px;
    }

    .date-value {
        color: #263b5b;
        font-weight: 700;
        white-space: nowrap;
    }

    .time-value {
        color: #5f5bba;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff4dc;
        color: #b77b16;
    }

    .status-confirmed {
        background: #e2f7ed;
        color: #218653;
    }

    .status-cancelled {
        background: #fde8e8;
        color: #c44747;
    }

    .status-rejected {
        background: #f0edf3;
        color: #766b80;
    }

    .notes-cell {
        max-width: 180px;
        color: #78849a !important;
        font-size: 13px !important;
    }

    .btn-cancel {
        background: #fff0f0;
        color: #d05252;
        border: 1px solid #f9dada;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 800;
        transition: all .2s ease;
    }

    .btn-cancel:hover {
        background: #d05252;
        color: white;
    }

    /* Review Design */
    .review-box {
        min-width: 190px;
        max-width: 240px;
    }

    .review-stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 4px;
        margin: 8px 0;
    }

    .review-stars input {
        display: none;
    }

    .review-stars label {
        color: #d9deea;
        font-size: 23px;
        cursor: pointer;
        transition: color .2s ease;
    }

    .review-stars label:hover,
    .review-stars label:hover ~ label,
    .review-stars input:checked ~ label {
        color: #f5b82e;
    }

    .review-comment {
        width: 100%;
        border: 1px solid #e5e9f2;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 12px;
        resize: vertical;
        outline: none;
        margin-bottom: 8px;
    }

    .review-comment:focus {
        border-color: #7771ee;
        box-shadow: 0 0 0 3px rgba(119, 113, 238, .1);
    }

    .btn-review {
        background: #7771ee;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 800;
        transition: all .2s ease;
    }

    .btn-review:hover {
        background: #625bd0;
        color: white;
    }

    .reviewed-box {
        min-width: 150px;
    }

    .reviewed-stars {
        color: #f5b82e;
        font-size: 15px;
        letter-spacing: 1px;
    }

    .reviewed-comment {
        color: #78849a;
        font-size: 12px;
        margin-top: 5px;
        max-width: 180px;
        overflow-wrap: anywhere;
    }

    .review-pending {
        color: #8792a5;
        font-size: 12px;
        font-weight: 700;
    }

    .empty-appointments {
        background: white;
        border-radius: 18px;
        padding: 65px 20px;
        text-align: center;
        box-shadow: 0 10px 35px rgba(16, 36, 72, .06);
    }

    .empty-icon {
        width: 85px;
        height: 85px;
        border-radius: 25px;
        background: #f0efff;
        color: #7771ee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        margin: 0 auto 22px;
    }

    .empty-appointments h4 {
        color: #172c4e;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .empty-appointments p {
        color: #8792a5;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .booking-alert {
        border-radius: 10px;
        font-size: 14px;
    }

    @media (max-width: 767px) {
        .appointments-page {
            padding: 30px 12px;
        }

        .appointments-heading h2 {
            font-size: 25px;
        }

        .appointments-header-content {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 18px;
        }

        .appointments-card-header {
            padding: 18px;
        }
    }
</style>

<div class="appointments-page">
    <div class="appointments-wrapper">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 appointments-header-content">
            <div class="appointments-heading">
                <h2>My Appointments</h2>
                <p>View and manage your clinic appointments.</p>
            </div>

            <a href="{{ route('appointments.create') }}" class="btn-book">
                <i class="fas fa-plus me-2"></i>
                Book New Appointment
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success booking-alert mb-4">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert alert-danger booking-alert mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger booking-alert mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($appointments->isEmpty())

            {{-- Empty State --}}
            <div class="empty-appointments">
                <div class="empty-icon">
                    <i class="fas fa-calendar-xmark"></i>
                </div>

                <h4>No Appointments Yet</h4>

                <p>
                    You haven't booked any appointments yet.
                    Start by finding the right doctor for you.
                </p>

                <a href="{{ route('appointments.create') }}" class="btn-book">
                    <i class="fas fa-calendar-plus me-2"></i>
                    Book Your First Appointment
                </a>
            </div>

        @else

            {{-- Appointments Table --}}
            <div class="appointments-card">

                <div class="appointments-card-header">
                    <h5>
                        <i class="fas fa-calendar-check me-2" style="color:#7771ee"></i>
                        Appointment History
                    </h5>

                    <span class="appointments-count">
                        {{ $appointments->count() }}
                        {{ $appointments->count() === 1 ? 'Appointment' : 'Appointments' }}
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table appointments-table align-middle">

                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Specialty</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Review</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($appointments as $appointment)

                                @php
                                    $appointmentDateTime = \Carbon\Carbon::parse(
                                        $appointment->appointment_date . ' ' . $appointment->appointment_time
                                    );

                                    $canReview = $appointment->status === 'confirmed'
                                        && $appointmentDateTime->isPast()
                                        && !$appointment->review;
                                @endphp

                                <tr>
                                    {{-- Doctor --}}
                                    <td>
                                        <div class="doctor-name">
                                            <i class="fas fa-user-doctor me-2" style="color:#817bff"></i>
                                            {{ $appointment->doctor->name }}
                                        </div>
                                    </td>

                                    {{-- Specialty --}}
                                    <td>
                                        <span class="specialty-name">
                                            {{ $appointment->doctor->specialty->name }}
                                        </span>
                                    </td>

                                    {{-- Date --}}
                                    <td>
                                        <span class="date-value">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                        </span>
                                    </td>

                                    {{-- Time --}}
                                    <td>
                                        <span class="time-value">
                                            <i class="far fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                        </span>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if ($appointment->status === 'pending')
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-hourglass-half me-1"></i>
                                                Pending
                                            </span>

                                        @elseif ($appointment->status === 'confirmed')
                                            <span class="status-badge status-confirmed">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Confirmed
                                            </span>

                                        @elseif ($appointment->status === 'cancelled')
                                            <span class="status-badge status-cancelled">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Cancelled
                                            </span>

                                        @elseif ($appointment->status === 'rejected')
                                            <span class="status-badge status-rejected">
                                                <i class="fas fa-ban me-1"></i>
                                                Rejected
                                            </span>

                                        @else
                                            <span class="status-badge status-rejected">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Notes --}}
                                    <td class="notes-cell">
                                        {{ $appointment->notes ?: '—' }}
                                    </td>

                                    {{-- Review --}}
                                    <td>
                                        @if ($appointment->review)

                                            <div class="reviewed-box">
                                                <div class="reviewed-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $appointment->review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                    @endfor
                                                </div>

                                                @if ($appointment->review->comment)
                                                    <div class="reviewed-comment">
                                                        {{ $appointment->review->comment }}
                                                    </div>
                                                @endif

                                                <small class="text-success fw-bold">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Reviewed
                                                </small>
                                            </div>

                                        @elseif ($canReview)

                                            <form
                                                action="{{ route('reviews.store') }}"
                                                method="POST"
                                                class="review-box"
                                            >
                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="appointment_id"
                                                    value="{{ $appointment->id }}"
                                                >

                                                <small class="fw-bold" style="color:#172c4e;">
                                                    Rate your experience
                                                </small>

                                                <div class="review-stars">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input
                                                            type="radio"
                                                            id="rating-{{ $appointment->id }}-{{ $i }}"
                                                            name="rating"
                                                            value="{{ $i }}"
                                                            required
                                                        >

                                                        <label for="rating-{{ $appointment->id }}-{{ $i }}">
                                                            <i class="fas fa-star"></i>
                                                        </label>
                                                    @endfor
                                                </div>

                                                <textarea
                                                    name="comment"
                                                    class="review-comment"
                                                    rows="2"
                                                    maxlength="1000"
                                                    placeholder="Write your feedback (optional)..."
                                                ></textarea>

                                                <button type="submit" class="btn-review">
                                                    <i class="fas fa-paper-plane me-1"></i>
                                                    Submit Review
                                                </button>
                                            </form>

                                        @else
                                            <span class="review-pending">
                                                <i class="far fa-star me-1"></i>
                                                Not available yet
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Action --}}
                                    <td>
                                        @if ($appointment->status === 'pending')

                                            <form
                                                action="{{ route('appointments.cancel', $appointment->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to cancel this appointment?');"
                                            >
                                                @csrf

                                                <button type="submit" class="btn-cancel">
                                                    <i class="fas fa-times me-1"></i>
                                                    Cancel
                                                </button>
                                            </form>

                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        @endif

    </div>
</div>

@endsection
