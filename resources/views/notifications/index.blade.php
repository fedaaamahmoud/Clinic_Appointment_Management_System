
@extends('layouts.app')

@section('content')

<style>
    .notifications-page {
        background: #f4f6fb;
        min-height: calc(100vh - 75px);
        padding: 50px 15px;
        font-family: 'Nunito', sans-serif;
    }

    .notifications-wrapper {
        max-width: 950px;
        margin: auto;
    }

    .notifications-heading h2 {
        color: #102448;
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .notifications-heading p {
        color: #8792a5;
        font-size: 15px;
        margin-bottom: 0;
    }

    .notifications-count {
        background: #f0efff;
        color: #6e67d9;
        border-radius: 20px;
        padding: 7px 13px;
        font-size: 12px;
        font-weight: 800;
    }

    .btn-mark-all {
        background: linear-gradient(110deg, #7771ee, #625bd0);
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 17px;
        font-size: 13px;
        font-weight: 800;
        transition: all .2s ease;
    }

    .btn-mark-all:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(111, 104, 220, .25);
    }

    .notification-card {
        background: white;
        border: 1px solid #edf0f5;
        border-radius: 15px;
        padding: 22px;
        margin-bottom: 16px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        box-shadow: 0 6px 22px rgba(16, 36, 72, .04);
        transition: all .2s ease;
    }

    .notification-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 36, 72, .07);
    }

    .notification-card.unread {
        border-left: 4px solid #817bff;
        background: #fdfdff;
    }

    .notification-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        background: #f0efff;
        color: #7771ee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .notification-icon.confirmed {
        background: #e4f7ed;
        color: #26945d;
    }

    .notification-icon.rejected {
        background: #fdeaea;
        color: #d05252;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-title {
        color: #172c4e;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .notification-details {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 20px;
        margin-bottom: 14px;
        color: #78849a;
        font-size: 13px;
    }

    .notification-details i {
        color: #817bff;
        margin-right: 5px;
    }

    .notification-status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .unread-label {
        background: #f0efff;
        color: #6e67d9;
    }

    .read-label {
        background: #edf0f4;
        color: #7c8799;
    }

    .btn-mark-read {
        background: #f0efff;
        color: #6e67d9;
        border: 1px solid #e2e0ff;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 800;
        transition: all .2s ease;
    }

    .btn-mark-read:hover {
        background: #7771ee;
        color: white;
    }

    .empty-notifications {
        background: white;
        border-radius: 17px;
        padding: 65px 20px;
        text-align: center;
        box-shadow: 0 8px 30px rgba(16, 36, 72, .05);
    }

    .empty-notifications-icon {
        width: 85px;
        height: 85px;
        border-radius: 25px;
        background: #f0efff;
        color: #7771ee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        margin: 0 auto 22px;
    }

    .empty-notifications h4 {
        color: #172c4e;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .empty-notifications p {
        color: #8792a5;
        font-size: 14px;
        margin: 0;
    }

    .notification-alert {
        border-radius: 10px;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .notifications-page {
            padding: 30px 12px;
        }

        .notifications-heading h2 {
            font-size: 25px;
        }

        .notification-card {
            padding: 16px;
            gap: 12px;
        }

        .notification-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
        }

        .notifications-header {
            align-items: flex-start !important;
            flex-direction: column;
            gap: 18px;
        }
    }
</style>

<div class="notifications-page">
    <div class="notifications-wrapper">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 notifications-header">

            <div class="notifications-heading">
                <h2>My Notifications</h2>
                <p>Stay updated with your appointment status and latest updates.</p>
            </div>

            @if(auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn-mark-all">
                        <i class="fas fa-check-double me-2"></i>
                        Mark All as Read
                    </button>
                </form>
            @endif

        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success notification-alert mb-4">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger notification-alert mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($notifications->isNotEmpty())

            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="notifications-count">
                    {{ $notifications->count() }}
                    {{ $notifications->count() === 1 ? 'Notification' : 'Notifications' }}
                </span>

                <span class="text-muted small">
                    {{ auth()->user()->unreadNotifications->count() }} unread
                </span>
            </div>

            {{-- Notifications List --}}
            @foreach($notifications as $notification)

                @php
                    $status = $notification->data['status'] ?? '';

                    $iconClass = $status === 'confirmed'
                        ? 'confirmed'
                        : ($status === 'rejected' ? 'rejected' : '');

                    $icon = $status === 'confirmed'
                        ? 'fa-check'
                        : ($status === 'rejected' ? 'fa-times' : 'fa-bell');
                @endphp

                <div class="notification-card {{ $notification->read_at ? '' : 'unread' }}">

                    <div class="notification-icon {{ $iconClass }}">
                        <i class="fas {{ $icon }}"></i>
                    </div>

                    <div class="notification-content">

                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <h5 class="notification-title">
                                {{ $notification->data['message'] ?? 'You have a new notification.' }}
                            </h5>

                            @if(!$notification->read_at)
                                <span class="notification-status unread-label">
                                    <i class="fas fa-circle me-1" style="font-size:7px"></i>
                                    New
                                </span>
                            @else
                                <span class="notification-status read-label">
                                    <i class="fas fa-check me-1"></i>
                                    Read
                                </span>
                            @endif
                        </div>

                        <div class="notification-details">

                            <span>
                                <i class="fas fa-user-doctor"></i>
                                {{ $notification->data['doctor_name'] ?? 'N/A' }}
                            </span>

                            <span>
                                <i class="fas fa-calendar"></i>
                                {{ $notification->data['appointment_date'] ?? 'N/A' }}
                            </span>

                            <span>
                                <i class="fas fa-clock"></i>
                                {{ !empty($notification->data['appointment_time'])
                                    ? \Carbon\Carbon::parse($notification->data['appointment_time'])->format('h:i A')
                                    : 'N/A' }}
                            </span>

                        </div>

                        @if(!$notification->read_at)
                            <form
                                action="{{ route('notifications.markAsRead', $notification->id) }}"
                                method="POST"
                            >
                                @csrf

                                <button type="submit" class="btn-mark-read">
                                    <i class="fas fa-check me-1"></i>
                                    Mark as Read
                                </button>
                            </form>
                        @endif

                    </div>
                </div>

            @endforeach

        @else

            {{-- Empty State --}}
            <div class="empty-notifications">
                <div class="empty-notifications-icon">
                    <i class="fas fa-bell-slash"></i>
                </div>

                <h4>You're All Caught Up!</h4>

                <p>You don't have any notifications yet. We'll let you know when there's an update.</p>
            </div>

        @endif

    </div>
</div>

@endsection
