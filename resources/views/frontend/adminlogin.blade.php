<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Paid Access</title>
    <style>
        body {
            background-color: #355691;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            width: 90vw;
            max-width: 1200px;
        }
        .form-container, .table-container {
            background-color: #fff;
            color: #000;
            border-radius: 5px;
            margin: 0 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: auto;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
        }
        form{
            text-align:center;
        }
        .table-container {
            flex: 2;
            max-width: 800px;
            overflow: auto;
            height: 400px; /* Adjust height as needed */
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table-container th {
            background-color: #000;
            color: #fff;
        }
        .form-container input, .form-container button {
            
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        .form-container input {
            border: 1px solid #ddd;
        }
        .form-container button {
            background-color: #000;
            color: #fff;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #333;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 100vw;
            }
            .form-container, .table-container {
                width: 90%;
                margin: 10px 0;
            }
            .table-container {
                height: auto; /* Adjust height as needed for mobile */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 style="color: black; margin-bottom: 20px;">Welcome</h1>
            <p>Just write email with a valid secret code.</p>
            <form action="{{ route('processLogin') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="hidden" name="secret_code" value="{{ session('secret_code') }}" placeholder="Code" required>
                
                @if (session('error'))
                <div class="error">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                <div class="success">{{ session('success') }}</div>
                @endif
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="table-container">
            <h1 style="color: black; margin-bottom: 20px;">User Payments</h1>
            <table>
                <thead>
                    <tr>
                        <th>Count</th>
                        <th>Email</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @php
                        $latestPayment = $user->userPayments()->latest()->first();
                        $paymentStatus = $latestPayment && str_starts_with($latestPayment->payment_id, 'PAYID') ? 'Free' : ($user->renew_status ? 'Yes' : 'No');
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $paymentStatus }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
