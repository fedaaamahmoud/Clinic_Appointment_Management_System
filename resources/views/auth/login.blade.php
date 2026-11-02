
@extends('layouts.app')

@section('content')

<style>
    .auth-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 55px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Nunito', sans-serif;
    }

    .auth-wrapper {
        width: 100%;
        max-width: 950px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: white;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(16, 36, 72, .08);
    }

    .auth-side {
        background: linear-gradient(145deg, #091a38, #183c68);
        padding: 55px 40px;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .auth-side::before,
    .auth-side::after {
        content: "";
        position: absolute;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
        width: 280px;
        height: 280px;
    }

    .auth-side::before {
        top: -130px;
        right: -120px;
    }

    .auth-side::after {
        bottom: -170px;
        left: -120px;
        width: 350px;
        height: 350px;
    }

    .auth-side-content {
        position: relative;
        z-index: 1;
    }

    .auth-logo-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: rgba(255,255,255,.13);
        color: #aaa5ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin-bottom: 28px;
    }

    .auth-side h2 {
        font-size: 30px;
        font-weight: 800;
        line-height: 1.4;
        margin-bottom: 15px;
    }

    .auth-side p {
        color: #c4d0e3;
        font-size: 15px;
        line-height: 1.8;
    }

    .auth-side-feature {
        margin-top: 30px;
        color: #e0e6f2;
        font-size: 14px;
    }

    .auth-side-feature i {
        color: #aaa5ff;
        margin-right: 9px;
    }

    .auth-form-side {
        padding: 55px 45px;
    }

    .auth-form-side h3 {
        color: #102448;
        font-weight: 800;
        font-size: 27px;
        margin-bottom: 8px;
    }

    .auth-subtitle {
        color: #8792a5;
        font-size: 14px;
        margin-bottom: 32px;
    }

    .auth-label {
        display: block;
        color: #263b5b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .auth-input-group {
        position: relative;
        margin-bottom: 22px;
    }

    .auth-input-group > i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #929bb0;
        font-size: 15px;
        z-index: 1;
    }

    .auth-control {
        width: 100%;
        height: 49px;
        border: 1px solid #e1e6f0;
        border-radius: 10px;
        padding: 10px 14px 10px 43px;
        color: #263b5b;
        font-size: 14px;
        transition: all .2s ease;
    }

    .auth-control:focus {
        border-color: #817bff;
        box-shadow: 0 0 0 3px rgba(129,123,255,.12);
        outline: none;
    }

    .auth-control.is-invalid {
        border-color: #dc3545;
    }

    .auth-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 25px;
        font-size: 13px;
    }

    .auth-options .form-check-label {
        color: #64728a;
    }

    .auth-options a {
        color: #716be0;
        text-decoration: none;
        font-weight: 700;
    }

    .auth-options a:hover {
        text-decoration: underline;
    }

    .auth-submit {
        width: 100%;
        height: 49px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(110deg, #7771ee, #625bd0);
        color: white;
        font-size: 15px;
        font-weight: 800;
        transition: all .25s ease;
        box-shadow: 0 6px 16px rgba(111,104,220,.2);
    }

    .auth-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(111,104,220,.3);
    }

    .auth-footer {
        color: #9aa3b3;
        text-align: center;
        font-size: 12px;
        margin-top: 25px;
    }

    @media (max-width: 767px) {
        .auth-page {
            padding: 30px 12px;
        }

        .auth-wrapper {
            grid-template-columns: 1fr;
        }

        .auth-side {
            padding: 30px;
        }

        .auth-side h2 {
            font-size: 24px;
        }

        .auth-side-feature {
            margin-top: 15px;
        }

        .auth-form-side {
            padding: 35px 25px;
        }
    }
</style>

<div class="auth-page">
    <div class="auth-wrapper">

        {{-- Welcome Side --}}
        <div class="auth-side">
            <div class="auth-side-content">

                <div class="auth-logo-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>

                <h2>Welcome Back to MediCare</h2>

                <p>
                    Your health matters to us.
                    Sign in to manage your appointments and stay connected with your doctors.
                </p>

                <div class="auth-side-feature">
                    <div class="mb-3">
                        <i class="fas fa-calendar-check"></i>
                        Manage your appointments
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-user-doctor"></i>
                        Connect with specialists
                    </div>

                    <div>
                        <i class="fas fa-bell"></i>
                        Stay updated with notifications
                    </div>
                </div>

            </div>
        </div>

        {{-- Login Form --}}
        <div class="auth-form-side">

            <h3>Sign In</h3>
            <p class="auth-subtitle">Enter your account details to continue.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="auth-label">Email Address</label>

                    <div class="auth-input-group">
                        <i class="fas fa-envelope"></i>

                        <input
                            id="email"
                            type="email"
                            class="auth-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                            autocomplete="email"
                            autofocus
                        >
                    </div>

                    @error('email')
                        <span class="text-danger small d-block mb-3">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="auth-label">Password</label>

                    <div class="auth-input-group">
                        <i class="fas fa-lock"></i>

                        <input
                            id="password"
                            type="password"
                            class="auth-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                    </div>

                    @error('password')
                        <span class="text-danger small d-block mb-3">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="auth-options">

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif

                </div>

                {{-- Submit --}}
                <button type="submit" class="auth-submit">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Login
                </button>

                <div class="auth-footer">
                    <i class="fas fa-shield-alt me-1"></i>
                    Your account information is kept secure.
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
