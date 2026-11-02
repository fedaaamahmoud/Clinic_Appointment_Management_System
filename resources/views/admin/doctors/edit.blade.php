
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold">Edit Doctor</h2>
        <p class="text-muted">Update the doctor's information.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.doctors.update', $doctor->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Doctor Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Doctor Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $doctor->name) }}"
                           required>
                </div>

                {{-- Specialty --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Specialty</label>

                    <select name="specialty_id" class="form-select" required>
                        <option value="">Select Specialty</option>

                        @foreach($specialties as $specialty)
                            <option value="{{ $specialty->id }}"
                                {{ old('specialty_id', $doctor->specialty_id) == $specialty->id ? 'selected' : '' }}>
                                {{ $specialty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $doctor->email) }}">
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ old('phone', $doctor->phone) }}">
                </div>

                {{-- Bio --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Bio</label>
                    <textarea name="bio"
                              class="form-control"
                              rows="4">{{ old('bio', $doctor->bio) }}</textarea>
                </div>

                <hr>

                <h5 class="fw-bold mb-3">Doctor Working Hours</h5>

                {{-- Working Days --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Working Days</label>

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

                        $selectedDays = old('working_days', $doctor->working_days ?? []);
                    @endphp

                    <div class="row">
                        @foreach($days as $day)
                            <div class="col-md-3 col-6 mb-2">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="working_days[]"
                                        value="{{ $day }}"
                                        class="form-check-input"
                                        id="day_{{ $day }}"
                                        {{ in_array($day, $selectedDays) ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="day_{{ $day }}">
                                        {{ $day }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @error('working_days')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    @error('working_days.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Start Time --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Start Time</label>

                    <input
                        type="time"
                        name="start_time"
                        class="form-control"
                        value="{{ old('start_time', $doctor->start_time ? substr($doctor->start_time, 0, 5) : '') }}"
                        required
                    >

                    @error('start_time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- End Time --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">End Time</label>

                    <input
                        type="time"
                        name="end_time"
                        class="form-control"
                        value="{{ old('end_time', $doctor->end_time ? substr($doctor->end_time, 0, 5) : '') }}"
                        required
                    >

                    @error('end_time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Save Changes
                    </button>

                    <a href="{{ route('admin.doctors.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
