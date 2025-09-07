@section('title', 'Account')

@include('layouts.admin.header_new')

<style>
    .bgc-f7 {
        background: transparent !important;
    }
    .account-container {
        box-shadow: 0 0 2px 2px #355691;
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
        <h1>Account Information</h1>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Folder Count:</strong> {{ $folderCount }}</p>
        <!-- Add more user information as needed -->

        <!-- Button to Cancel Recurring Payment -->
        <form action="{{ route('cancelSubscription') }}" method="POST">
            @csrf
            <button type="submit" class="cancel-button">Cancel Recurring Payment</button>
        </form>
    </div>
</div>

@include('layouts.admin.footer_new')