
@extends('layouts.app')

@section('content')

<style>
    .auth-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 45px 15px;
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
        padding: 50px 40px;
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
        padding: 45px 45px;
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
        margin-bottom: 28px;
    }

    .auth-label {
        display: block;
        color: #263b5b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .auth-input-group {
        position: relative;
        margin-bottom: 18px;
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
        height: 47px;
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
        margin-top: 8px;
    }

    .auth-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 20px rgba(111,104,220,.3);
    }

    .auth-footer {
        color: #9aa3b3;
        text-align: center;
        font-size: 13px;
        margin-top: 22px;
    }

    .auth-footer a {
        color: #716be0;
        font-weight: 800;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
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

                <h2>Join MediCare Today</h2>

                <p>
                    Create your account and take the first step
                    towards better healthcare. Manage your appointments
                    and connect with trusted medical specialists.
                </p>

                <div class="auth-side-feature">
                    <div class="mb-3">
                        <i class="fas fa-user-plus"></i>
                        Create your personal account
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-calendar-check"></i>
                        Book appointments easily
                    </div>

                    <div>
                        <i class="fas fa-heart"></i>
                        Take care of your health
                    </div>
                </div>

            </div>
        </div>

        {{-- Register Form --}}
        <div class="auth-form-side">

            <h3>Create Account</h3>
            <p class="auth-subtitle">
                Fill in your details to get started.
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="auth-label">Full Name</label>

                    <div class="auth-input-group">
                        <i class="fas fa-user"></i>

                        <input
                            id="name"
                            type="text"
                            class="auth-control @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required
                            autocomplete="name"
                            autofocus
                        >
                    </div>

                    @error('name')
                        <span class="text-danger small d-block mb-3">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

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
                            placeholder="Create a password"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    @error('password')
                        <span class="text-danger small d-block mb-3">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password-confirm" class="auth-label">
                        Confirm Password
                    </label>

                    <div class="auth-input-group">
                        <i class="fas fa-lock"></i>

                        <input
                            id="password-confirm"
                            type="password"
                            class="auth-control"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="auth-submit">
                    <i class="fas fa-user-plus me-2"></i>
                    Create Account
                </button>

                <div class="auth-footer">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign In</a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection

