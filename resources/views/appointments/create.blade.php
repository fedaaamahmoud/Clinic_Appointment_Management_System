
@extends('layouts.app')

@section('content')

<style>
    .booking-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 55px 15px;
        font-family: 'Nunito', sans-serif;
    }

    .booking-wrapper {
        max-width: 950px;
        margin: auto;
    }

    .booking-heading {
        margin-bottom: 28px;
    }

    .booking-heading h2 {
        color: #102448;
        font-weight: 800;
        font-size: 30px;
        margin-bottom: 8px;
    }

    .booking-heading p {
        color: #7b879b;
        font-size: 15px;
        margin: 0;
    }

    .booking-card {
        background: #fff;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(16, 36, 72, 0.07);
    }

    .booking-header {
        background: linear-gradient(120deg, #091a38, #183c68);
        padding: 28px 35px;
        color: white;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .booking-header-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        background: rgba(255,255,255,0.13);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        color: #a9a5ff;
    }

    .booking-header h4 {
        font-weight: 800;
        margin: 0 0 5px;
    }

    .booking-header p {
        color: #c4d0e3;
        font-size: 14px;
        margin: 0;
    }

    .booking-body {
        padding: 35px;
    }

    .section-title {
        color: #152c50;
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .booking-label {
        display: block;
        color: #263b5b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .booking-label i {
        color: #817bff;
        width: 20px;
        margin-right: 4px;
    }

    .booking-control {
        width: 100%;
        min-height: 48px;
        border: 1px solid #e1e6f0;
        border-radius: 10px;
        padding: 10px 14px;
        color: #263b5b;
        background-color: #fff;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .booking-control:focus {
        border-color: #817bff;
        box-shadow: 0 0 0 3px rgba(129, 123, 255, 0.12);
        outline: none;
    }

    .booking-control:disabled {
        background: #f3f5f9;
        color: #9ba5b5;
        cursor: not-allowed;
    }

    textarea.booking-control {
        min-height: 105px;
        resize: vertical;
    }

    .booking-field {
        margin-bottom: 23px;
    }

    .schedule-box {
        background: #f2f3ff;
        border: 1px solid #e1e0ff;
        border-radius: 13px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .schedule-title {
        color: #343078;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .schedule-item {
        color: #53617b;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .schedule-item:last-child {
        margin-bottom: 0;
    }

    .schedule-item strong {
        color: #24365b;
    }

    .booking-divider {
        border: 0;
        border-top: 1px solid #edf0f5;
        margin: 28px 0;
    }

    .booking-submit {
        background: linear-gradient(110deg, #7771ee, #625bd0);
        border: none;
        border-radius: 10px;
        padding: 13px 27px;
        color: white;
        font-weight: 800;
        font-size: 15px;
        transition: all 0.25s ease;
        box-shadow: 0 6px 16px rgba(111, 104, 220, 0.22);
    }

    .booking-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(111, 104, 220, 0.3);
        color: white;
    }

    .booking-note {
        color: #8994a8;
        font-size: 13px;
        margin-top: 12px;
    }

    .booking-alert {
        border-radius: 10px;
        font-size: 14px;
    }

    .booking-error {
        display: block;
        font-size: 12px;
        margin-top: 6px;
    }

    @media (max-width: 576px) {
        .booking-page {
            padding: 30px 12px;
        }

        .booking-header {
            padding: 22px;
        }

        .booking-body {
            padding: 22px;
        }

        .booking-heading h2 {
            font-size: 24px;
        }
    }
</style>

<div class="booking-page">
    <div class="booking-wrapper">

        <div class="booking-heading">
            <h2>Book Your Appointment</h2>
            <p>Find the right specialist and schedule your visit with ease.</p>
        </div>

        <div class="booking-card">

            <div class="booking-header">
                <div class="booking-header-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>

                <div>
                    <h4>New Appointment</h4>
                    <p>Complete the information below to book your visit.</p>
                </div>
            </div>

            <div class="booking-body">

                @if ($errors->any())
                    <div class="alert alert-danger booking-alert">
                        <strong>Please check the following:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST" id="bookingForm">
                    @csrf

                    <h5 class="section-title">
                        <i class="fas fa-user-md me-2" style="color:#817bff"></i>
                        Doctor Information
                    </h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="booking-field">
                                <label class="booking-label" for="specialty">
                                    <i class="fas fa-stethoscope"></i>
                                    Specialty
                                </label>

                                <select class="booking-control" id="specialty" name="specialty_id" required>
                                    <option value="">Choose Specialty</option>

                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}"
                                            {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="booking-field">
                                <label class="booking-label" for="doctor">
                                    <i class="fas fa-user-doctor"></i>
                                    Doctor
                                </label>

                                <select class="booking-control" id="doctor" name="doctor_id" required disabled>
                                    <option value="">Choose Doctor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="doctorSchedule" class="schedule-box d-none">
                        <h6 class="schedule-title">
                            <i class="fas fa-clock me-2"></i>
                            Doctor's Working Schedule
                        </h6>

                        <p class="schedule-item">
                            <strong><i class="fas fa-calendar-days me-2"></i>Working Days:</strong>
                            <span id="workingDays"></span>
                        </p>

                        <p class="schedule-item">
                            <strong><i class="fas fa-business-time me-2"></i>Working Hours:</strong>
                            <span id="workingHours"></span>
                        </p>
                    </div>

                    <hr class="booking-divider">

                    <h5 class="section-title">
                        <i class="fas fa-calendar-alt me-2" style="color:#817bff"></i>
                        Appointment Details
                    </h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="booking-field">
                                <label class="booking-label" for="appointmentDate">
                                    <i class="fas fa-calendar"></i>
                                    Appointment Date
                                </label>

                                <input
                                    type="date"
                                    id="appointmentDate"
                                    name="appointment_date"
                                    class="booking-control"
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ old('appointment_date') }}"
                                    required
                                    disabled
                                >

                                <small id="dateMessage" class="text-danger booking-error"></small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="booking-field">
                                <label class="booking-label" for="appointmentTime">
                                    <i class="fas fa-clock"></i>
                                    Appointment Time
                                </label>

                                <select
                                    id="appointmentTime"
                                    name="appointment_time"
                                    class="booking-control"
                                    required
                                    disabled
                                >
                                    <option value="">Choose Date First</option>
                                </select>

                                <small id="timeMessage" class="text-danger booking-error"></small>
                            </div>
                        </div>
                    </div>

                    <hr class="booking-divider">

                    <h5 class="section-title">
                        <i class="fas fa-notes-medical me-2" style="color:#817bff"></i>
                        Additional Information
                    </h5>

                    <div class="booking-field">
                        <label class="booking-label" for="notes">
                            <i class="fas fa-pen"></i>
                            Notes <span class="text-muted fw-normal">(Optional)</span>
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            class="booking-control"
                            rows="3"
                            placeholder="Write any additional notes or describe your concerns..."
                        >{{ old('notes') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="booking-submit">
                            <i class="fas fa-calendar-check me-2"></i>
                            Book Appointment
                        </button>

                        <p class="booking-note">
                            <i class="fas fa-shield-alt me-1"></i>
                            Your appointment information is handled securely.
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const specialties = @json($specialties);

    const specialtySelect = document.getElementById('specialty');
    const doctorSelect = document.getElementById('doctor');
    const dateInput = document.getElementById('appointmentDate');
    const timeInput = document.getElementById('appointmentTime');

    const scheduleBox = document.getElementById('doctorSchedule');
    const workingDaysText = document.getElementById('workingDays');
    const workingHoursText = document.getElementById('workingHours');

    const dateMessage = document.getElementById('dateMessage');
    const timeMessage = document.getElementById('timeMessage');

    const oldSpecialtyId = @json(old('specialty_id'));
    const oldDoctorId = @json(old('doctor_id'));
    const oldAppointmentTime = @json(old('appointment_time'));

    let selectedDoctor = null;

    const dayNames = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    function resetSchedule() {
        selectedDoctor = null;

        scheduleBox.classList.add('d-none');

        dateInput.disabled = true;
        timeInput.disabled = true;

        dateInput.value = '';
        timeInput.innerHTML = '<option value="">Choose Date First</option>';

        dateMessage.textContent = '';
        timeMessage.textContent = '';

        dateInput.setCustomValidity('');
    }

    function loadDoctors(specialtyId, selectedDoctorId = null) {
        doctorSelect.innerHTML = '<option value="">Choose Doctor</option>';

        resetSchedule();

        if (!specialtyId) {
            doctorSelect.disabled = true;
            return;
        }

        const specialty = specialties.find(
            item => item.id == specialtyId
        );

        if (!specialty || !specialty.doctors.length) {
            doctorSelect.disabled = true;
            return;
        }

        specialty.doctors.forEach(doctor => {
            const option = document.createElement('option');

            option.value = doctor.id;
            option.textContent = doctor.name;

            if (doctor.id == selectedDoctorId) {
                option.selected = true;
            }

            doctorSelect.appendChild(option);
        });

        doctorSelect.disabled = false;

        if (selectedDoctorId) {
            showDoctorSchedule(selectedDoctorId);
        }
    }

    function showDoctorSchedule(doctorId) {
        const specialty = specialties.find(
            item => item.id == specialtySelect.value
        );

        selectedDoctor = specialty?.doctors.find(
            doctor => doctor.id == doctorId
        );

        if (!selectedDoctor) {
            resetSchedule();
            return;
        }

        const days = selectedDoctor.working_days || [];

        workingDaysText.textContent = days.length
            ? days.join(', ')
            : 'Not specified';

        const startTime = selectedDoctor.start_time?.substring(0, 5);
        const endTime = selectedDoctor.end_time?.substring(0, 5);

        workingHoursText.textContent = startTime && endTime
            ? `${startTime} - ${endTime}`
            : 'Not specified';

        scheduleBox.classList.remove('d-none');

        dateInput.disabled = false;
        timeInput.disabled = true;

        timeInput.innerHTML = '<option value="">Choose Date First</option>';

        validateDate();
    }

    function validateDate() {
        dateMessage.textContent = '';

        if (!dateInput.value || !selectedDoctor) {
            dateInput.setCustomValidity('');
            return true;
        }

        const date = new Date(dateInput.value + 'T00:00:00');
        const selectedDay = dayNames[date.getDay()];
        const workingDays = selectedDoctor.working_days || [];

        if (!workingDays.includes(selectedDay)) {
            dateMessage.textContent =
                'The doctor does not work on this day. Please choose another date.';

            dateInput.setCustomValidity(
                'The doctor does not work on this day.'
            );

            return false;
        }

        dateInput.setCustomValidity('');
        return true;
    }

    async function loadAvailableTimes() {
        timeInput.innerHTML = '<option value="">Loading times...</option>';
        timeInput.disabled = true;
        timeMessage.textContent = '';

        if (!selectedDoctor || !dateInput.value) {
            timeInput.innerHTML = '<option value="">Choose Date First</option>';
            return;
        }

        if (!validateDate()) {
            timeInput.innerHTML = '<option value="">Choose a working day</option>';
            return;
        }

        if (!selectedDoctor.start_time || !selectedDoctor.end_time) {
            timeInput.innerHTML =
                '<option value="">Working hours not specified</option>';

            timeMessage.textContent =
                'Doctor working hours are not configured.';

            return;
        }

        try {
            const url =
                `{{ route('appointments.bookedTimes') }}?doctor_id=${selectedDoctor.id}&appointment_date=${dateInput.value}`;

            const response = await fetch(url);
            const data = await response.json();

            if (!response.ok) {
                throw new Error(
                    data.message || 'Could not load available times.'
                );
            }

            const bookedTimes = (data.booked_times || []).map(time =>
                String(time).substring(0, 5)
            );

            const start = selectedDoctor.start_time.substring(0, 5);
            const end = selectedDoctor.end_time.substring(0, 5);

            const toMinutes = time => {
                const [hours, minutes] = time.split(':').map(Number);
                return hours * 60 + minutes;
            };

            const startMinutes = toMinutes(start);
            const endMinutes = toMinutes(end);

            timeInput.innerHTML =
                '<option value="">Choose Available Time</option>';

            let availableCount = 0;

            for (
                let minutes = startMinutes;
                minutes + 30 <= endMinutes;
                minutes += 30
            ) {
                const hours = String(Math.floor(minutes / 60)).padStart(2, '0');
                const mins = String(minutes % 60).padStart(2, '0');

                const time = `${hours}:${mins}`;

                if (bookedTimes.includes(time)) {
                    continue;
                }

                const option = document.createElement('option');

                option.value = time;
                option.textContent = time;

                if (time === oldAppointmentTime) {
                    option.selected = true;
                }

                timeInput.appendChild(option);
                availableCount++;
            }

            if (availableCount === 0) {
                timeInput.innerHTML =
                    '<option value="">No Available Times</option>';

                timeMessage.textContent =
                    'No available appointments for this date.';
            }

            timeInput.disabled = availableCount === 0;

        } catch (error) {
            timeInput.innerHTML =
                '<option value="">Error Loading Times</option>';

            timeMessage.textContent = error.message;
        }
    }

    specialtySelect.addEventListener('change', function () {
        loadDoctors(this.value);
    });

    doctorSelect.addEventListener('change', function () {
        showDoctorSchedule(this.value);

        if (dateInput.value) {
            loadAvailableTimes();
        }
    });

    dateInput.addEventListener('change', function () {
        validateDate();
        loadAvailableTimes();
    });

    document.getElementById('bookingForm').addEventListener('submit', function (event) {
        if (
            !validateDate() ||
            !timeInput.value ||
            timeInput.disabled
        ) {
            event.preventDefault();
        }
    });

    // Restore previous selections after validation errors
    if (oldSpecialtyId) {
        loadDoctors(oldSpecialtyId, oldDoctorId);

        if (oldDoctorId && dateInput.value) {
            loadAvailableTimes();
        }
    }
</script>

@endsection

