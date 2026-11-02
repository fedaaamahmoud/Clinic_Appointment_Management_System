
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
        margin-bottom: 25px;
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

    .form-card-body {
        padding: 28px;
    }

    .section-title {
        color: #102448;
        font-size: 16px;
        font-weight: 800;
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #716be0;
    }

    .form-label {
        color: #34445e;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 45px;
        border: 1px solid #e3e7f0;
        border-radius: 9px;
        padding: 10px 13px;
        color: #34445e;
        font-size: 13px;
        box-shadow: none !important;
    }

    textarea.form-control {
        min-height: 125px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #8b85ed;
        box-shadow: 0 0 0 3px rgba(113,107,224,.10) !important;
    }

    .form-control::placeholder {
        color: #aab2c1;
    }

    .field-hint {
        color: #929caf;
        font-size: 12px;
        margin-top: 7px;
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

    .alert {
        border-radius: 10px;
        font-size: 13px;
    }

    .field-error {
        color: #d34f55;
        font-size: 12px;
        margin-top: 6px;
    }

    @media (max-width: 576px) {
        .admin-page {
            padding-top: 25px;
        }

        .page-heading h2 {
            font-size: 23px;
        }

        .form-card-body {
            padding: 20px;
        }
    }
</style>

<div class="admin-page">
    <div class="container">

        {{-- Page Heading --}}
        <div class="page-heading">
            <h2>Add New Specialty</h2>
            <p>Enter the medical specialty information below.</p>
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
                    <i class="fas fa-stethoscope"></i>
                </div>

                <div>
                    <h4>Specialty Information</h4>
                    <p>Fill in the details to create a new specialty.</p>
                </div>
            </div>

            <div class="form-card-body">

                <form action="{{ route('admin.specialties.store') }}"
                      method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="form-label">
                            Specialty Name *
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="e.g. Cardiology, Dermatology"
                            required
                        >

                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <div class="field-hint">
                            Enter the name of the medical specialty.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            placeholder="Enter specialty description">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                        <div class="field-hint">
                            Add a short description about this specialty (optional).
                        </div>
                    </div>

                    <hr style="border-color:#edf0f6; margin:25px 0;">

                    {{-- Form Actions --}}
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="fas fa-save"></i>
                            Save Specialty
                        </button>

                        <a href="{{ route('admin.specialties.index') }}"
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
