
@extends('layouts.app')

@section('content')

<style>
    .admin-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 35px 0 55px;
        font-family: 'Nunito', sans-serif;
    }

    .page-heading { margin-bottom: 25px; }

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

    .form-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 22px rgba(16,36,72,.045);
        overflow: hidden;
    }

    .form-card-header {
        padding: 22px 28px;
        border-bottom: 1px solid #edf0f6;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .header-icon {
        width: 45px;
        height: 45px;
        border-radius: 13px;
        background: #f0efff;
        color: #716be0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .form-card-header h4 {
        color: #102448;
        font-size: 17px;
        font-weight: 800;
        margin: 0 0 4px;
    }

    .form-card-header p {
        color: #929caf;
        font-size: 12px;
        margin: 0;
    }

    .form-card-body { padding: 28px; }

    .section-title {
        color: #102448;
        font-size: 16px;
        font-weight: 800;
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i { color: #716be0; }

    .form-label {
        color: #34445e;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        min-height: 45px;
        border: 1px solid #e3e7f0;
        border-radius: 9px;
        padding: 10px 13px;
        color: #34445e;
        font-size: 13px;
        box-shadow: none !important;
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8b85ed;
        box-shadow: 0 0 0 3px rgba(113,107,224,.10) !important;
    }

    .form-control::placeholder { color: #aab2c1; }

    .form-section {
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #edf0f6;
    }

    .days-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
    }

    .day-option {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 12px;
        background: #f8f9fc;
        border: 1px solid #e9ecf3;
        border-radius: 9px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .day-option:hover {
        background: #f3f2ff;
        border-color: #c9c6fa;
    }

    .day-option .form-check-input {
        margin: 0;
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: #716be0;
    }

    .day-option .form-check-input:checked {
        background-color: #716be0;
        border-color: #716be0;
    }

    .day-option label {
        color: #42516a;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        margin: 0;
    }

    .admin-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 19px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: all .2s ease;
        border: none;
    }

    .admin-btn-primary {
        color: white;
        background: linear-gradient(110deg, #7771ee, #625bd0);
    }

    .admin-btn-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 7px 16px rgba(111,104,220,.22);
    }

    .admin-btn-outline {
        color: #64718a;
        background: white;
        border: 1px solid #dfe4ee;
    }

    .admin-btn-outline:hover {
        color: #625bd0;
        background: #f4f3ff;
        border-color: #dcdafe;
    }

    .field-error {
        color: #d34f55;
        font-size: 12px;
        margin-top: 6px;
    }

    .alert {
        border-radius: 10px;
        font-size: 13px;
    }

    .section-note {
        color: #929caf;
        font-size: 12px;
        margin-top: -12px;
        margin-bottom: 18px;
    }

    @media (max-width: 768px) {
        .days-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .form-card-body { padding: 20px; }
    }

    @media (max-width: 576px) {
        .admin-page { padding-top: 25px; }
        .page-heading h2 { font-size: 23px; }
        .days-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
</style>

<div class="admin-page">
    <div class="container">

        <div class="page-heading">
            <h2>Add New Doctor</h2>
            <p>Enter the doctor's personal information and working schedule.</p>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="fw-bold mb-2">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Please check the following errors:
                </div>

                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">

            <div class="form-card-header">
                <div class="header-icon">
                    <i class="fas fa-user-doctor"></i>
                </div>

                <div>
                    <h4>Doctor Information</h4>
                    <p>Fill in the details below to add a doctor.</p>
                </div>
            </div>

            <div class="form-card-body">

                <form action="{{ route('admin.doctors.store') }}" method="POST">
                    @csrf

                    {{-- Personal Information --}}
                    <div class="form-section">

                        <h5 class="section-title">
                            <i class="fas fa-user"></i>
                            Personal Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Doctor Name *</label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="Enter doctor name"
                                    required
                                >

                                @error('name')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Specialty *</label>

                                <select name="specialty_id" class="form-select" required>
                                    <option value="">Select Specialty</option>

                                    @foreach($specialties as $specialty)
                                        <option
                                            value="{{ $specialty->id }}"
                                            {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('specialty_id')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Account Information --}}
                            <div class="col-12 mt-2 mb-3">
                                <h5 class="section-title">
                                    <i class="fas fa-lock"></i>
                                    Login Account Information
                                </h5>

                                <p class="section-note">
                                    Create the email and password the doctor will use to log in.
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="doctor@example.com"
                                    required
                                    autocomplete="off"
                                >

                                @error('email')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                    placeholder="Enter phone number"
                                >

                                @error('phone')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password *</label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="At least 8 characters"
                                    required
                                    autocomplete="new-password"
                                >

                                @error('password')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm Password *</label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Re-enter password"
                                    required
                                    autocomplete="new-password"
                                >
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Bio</label>

                                <textarea
                                    name="bio"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter doctor information">{{ old('bio') }}</textarea>

                                @error('bio')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Working Schedule --}}
                    <div class="form-section">

                        <h5 class="section-title">
                            <i class="fas fa-calendar-days"></i>
                            Doctor Working Hours
                        </h5>

                        <div class="mb-4">
                            <label class="form-label d-block">Working Days *</label>

                            @php
                                $days = [
                                    'Saturday',
                                    'Sunday',
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday'
                                ];
                            @endphp

                            <div class="days-grid">
                                @foreach($days as $day)
                                    <div class="day-option">
                                        <input
                                            type="checkbox"
                                            name="working_days[]"
                                            value="{{ $day }}"
                                            class="form-check-input"
                                            id="day_{{ $day }}"
                                            {{ in_array($day, old('working_days', [])) ? 'checked' : '' }}
                                        >

                                        <label for="day_{{ $day }}">
                                            {{ $day }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('working_days')
                                <div class="field-error">{{ $message }}</div>
                            @enderror

                            @error('working_days.*')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Time *</label>

                                <input
                                    type="time"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time') }}"
                                    required
                                >

                                @error('start_time')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Time *</label>

                                <input
                                    type="time"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time') }}"
                                    required
                                >

                                @error('end_time')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="d-flex flex-wrap gap-2">

                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Doctor
                        </button>

                        <a href="{{ route('admin.doctors.index') }}"
                           class="admin-btn admin-btn-outline">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection


