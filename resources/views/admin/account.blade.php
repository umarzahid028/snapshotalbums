@section('title', 'Account')

@include('layouts.admin.header_new')

<style>
    .bgc-f7 {
        background: transparent !important;
    }
    .account-container {
        box-shadow: 0 0 0px 1px #21252914;
    }
    .cancel-button {
        background-color: #ff0000;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .cancel-button:hover {
        background-color: #d40000;
    }
</style>

<div class="container mt-4">
    <div class="ps-widget bgc-white bdrs12 p30 mb30 overflow-hidden position-relative account-container">
        <h1 style="color:black; margin-bottom:20px">Account Information</h1>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Folder Count:</strong> {{ $folderCount }}</p>

        @if ($user->userPayments()->exists())
            @php
                $latestPayment = $user->userPayments()->latest()->first();
                $subscriptionEndDate = $latestPayment->updated_at->addYear()->format('m/d/Y');
            @endphp

            @if (!str_starts_with($latestPayment->payment_id, 'PAYID') && $user->renew_status == "1")
                @if ($user->plan === 'premium')
                    <p>Access your <a href="https://snapshot-albums.com/templates" style="color:#355691" target="_blank"><strong>Canva™ templates</strong></a> to create unique flyers for your event! Use your album QR codes on your flyers so your guests can easily upload photos.<br><br>
                    Your recurring payment has been turned on. Your subscription will automatically renew on {{ $subscriptionEndDate }} to keep your account active. If you have any issues, <a href="/contact-us">contact us</a>.</p>
                @else
                    <p style="color:red"><strong>Canva™ templates are available only on the Premium plan.</strong> <a href="{{ route('subscribe.form') }}">Upgrade now</a> to unlock this feature.</p>
                @endif
                <button class="renew-button btn btn-danger" onclick="event.preventDefault(); document.getElementById('toggle-renew-form-{{ $user->id }}').submit();">
                    Cancel Subscription Payment
                </button>

            @elseif (!str_starts_with($latestPayment->payment_id, 'PAYID') && $user->renew_status == "0")
                @if ($user->plan === 'premium')
                    <p>Your subscription will not be automatically renewed after {{ $subscriptionEndDate }}. You will continue to have Premium access until your subscription ends. 
                    If you change your mind, you can reactivate your subscription payment below.<br><br>To regain access to your <a href="https://snapshot-albums.com/templates" style="color:#355691" target="_blank"><strong>Canva™ templates</strong></a> and other premium user features, reactivate now.</p>
                @else
                    <p style="color:red"><strong>Canva™ templates are available only on the Premium plan.</strong> <a href="{{ route('subscribe.form') }}">Upgrade now</a> to unlock this feature.</p>
                @endif
                <button class="renew-button btn btn-success" onclick="event.preventDefault(); document.getElementById('toggle-renew-form-{{ $user->id }}').submit();">
                    Reactivate Subscription Payment
                </button>

            @elseif (str_starts_with($latestPayment->payment_id, 'PAYID') && $user->renew_status == "0")
                @if ($user->plan === 'premium')
                    <p>Your Snapshot Albums Pro account has been turned on by an administrator. If you have any issues, <a href="/contact-us">contact us</a>.<br><br>
                    Access your <a href="https://snapshot-albums.com/templates" style="color:#355691" target="_blank"><strong>Canva™ templates</strong></a> to create unique flyers for your event! Use your album QR codes on your flyers so your guests can easily upload photos.</p>
                @else
                    <p style="color:red"><strong>Canva™ templates are available only on the Premium plan.</strong> <a href="{{ route('subscribe.form') }}">Upgrade now</a> to unlock this feature.</p>
                @endif
            @endif
        @endif

        <form id="toggle-renew-form-{{ $user->id }}" action="{{ route('toggle.renew.status', ['userId' => $user->id]) }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

@include('layouts.admin.footer_new')
