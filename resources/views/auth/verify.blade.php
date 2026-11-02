
@extends('layouts.app')

@section('content')

<style>
    .verify-page {
        min-height: calc(100vh - 75px);
        background: #f4f6fb;
        padding: 55px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Nunito', sans-serif;
    }

    .verify-card {
        width: 100%;
        max-width: 650px;
        background: #fff;
        border-radius: 20px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 15px 45px rgba(16, 36, 72, .08);
    }

    .verify-icon {
        width: 85px;
        height: 85px;
        border-radius: 25px;
        background: #f0efff;
        color: #716be0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin: 0 auto 25px;
    }

    .verify-card h2 {
        color: #102448;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .verify-description {
        color: #8792a5;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .verify-alert {
        background: #eaf8f0;
        color: #218653;
        border: 1px solid #ccebd9;
        border-radius: 10px;
        padding: 13px 15px;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .verify-note {
        color: #64728a;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 22px;
    }

    .verify-button {
        display: inline-block;
        border: none;
        border-radius: 10px;
        padding: 13px 25px;
        background: linear-gradient(110deg, #7771ee, #625bd0);
        color: white;
        font-size: 14px;
        font-weight: 800;
        transition: all .25s ease;
        cursor: pointer;
    }

    .verify-button:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(111,104,220,.25);
    }

    @media (max-width: 576px) {
        .verify-card {
            padding: 35px 22px;
        }

        .verify-card h2 {
            font-size: 22px;
        }
    }
</style>

<div class="verify-page">
    <div class="verify-card">

        <div class="verify-icon">
            <i class="fas fa-envelope-circle-check"></i>
        </div>

        <h2>Verify Your Email Address</h2>

        <p class="verify-description">
            One more step to get started with MediCare.
            Please check your inbox and verify your email address.
        </p>

        @if (session('resent'))
            <div class="verify-alert" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        <p class="verify-note">
            <i class="fas fa-info-circle me-1"></i>
            Before proceeding, please check your email for a verification link.
            If you did not receive the email, you can request another link below.
        </p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf

            <button type="submit" class="verify-button">
                <i class="fas fa-paper-plane me-2"></i>
                Resend Verification Email
            </button>
        </form>

    </div>
</div>

@endsection
