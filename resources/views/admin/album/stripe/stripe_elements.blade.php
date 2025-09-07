@include('layouts.admin.header_new')

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .bgc-f7{
            background-color:transparent !important;
        }
        .error-message-container {
            margin: 15px 0;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            color: #721c24;
        }
        .error-message-container.hide {
            display: none;
        }
        .has-error input {
            border-color: #dc3545;
        }
        .card-validation {
            margin-bottom: 15px;
        }
        .card-validation .form-control {
            margin-bottom: 10px;
        }
        .card-type-indicator {
            margin-top: 5px;
            font-size: 12px;
            color: #666;
        }
        .valid-card {
            border-color: #28a745 !important;
        }
        .invalid-card {
            border-color: #dc3545 !important;
        }
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
        #payment-element {
            margin: 20px 0;
        }
        .payment-element-container {
            background: #fff;
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .stripe-button {
            background: #635bff;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .stripe-button:hover {
            background: #5a52e5;
        }
        .stripe-button:disabled {
            background: #aab7c4;
            cursor: not-allowed;
        }
        .hidden {
            display: none;
        }
        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #635bff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: none; /* Hidden by default */
            margin-left: 10px;
        }
        .spinner.show {
            display: inline-block; /* Show when needed */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #payment-message {
            margin: 15px 0;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        #payment-message.error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        #payment-message.success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
    </style>
</head>
<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    @php
        $selectedPlan = session('selected_plan');
        if (!$selectedPlan) {
            $selectedPlan = [
                'name' => 'premium',
                'price' => 999,
                'description' => 'Premium Plan - Unlimited Albums',
                'features' => ['Unlimited Albums', 'All Premium Features', 'Priority Support']
            ];
        }
        $priceDisplay = '$' . number_format($selectedPlan['price'] / 100, 2);
        $planName = ucfirst($selectedPlan['name']);
    @endphp
    
    <h1 style="color: black;">Snapshot Albums {{ $planName }} - {{ $priceDisplay }}/month</h1>
    <p>Complete the payment information below to enable access to <strong>{{ $planName }}</strong> features.<br>
    Payment is fulfilled securely by Stripe&trade;</p>
    
    <!-- Plan Details -->
    <div class="alert alert-info">
        <h4>{{ $planName }} Plan Features:</h4>
        <ul>
            @foreach($selectedPlan['features'] as $feature)
                <li>{{ $feature }}</li>
            @endforeach
        </ul>
        <strong>Price: {{ $priceDisplay }}/month</strong>
    </div>
    
    <!-- Stripe Elements Form -->
    <form id="payment-form" action="{{ route('stripe.post') }}" method="post">
        @csrf
        <input type="hidden" name="plan_name" value="{{ $selectedPlan['name'] }}">
        <input type="hidden" name="plan_price" value="{{ $selectedPlan['price'] }}">
        
        <div class="payment-element-container">
            <div id="payment-element">
                <!-- Stripe Elements will be inserted here -->
            </div>
        </div>
        
        <div class="text-end">
            <button id="submit" class="stripe-button">
                <span id="button-text">Pay Now ({{ $priceDisplay }})</span>
                <div id="spinner" class="spinner"></div>
            </button>
        </div>
        
        <div id="payment-message" class="hidden"></div>
    </form>

</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // This is your test publishable API key.
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    
    let elements;
    
    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initialize();
    });
    
    document
        .querySelector("#payment-form")
        .addEventListener("submit", handleSubmit);
    
    async function initialize() {
        try {
            const { clientSecret } = await fetch("{{ route('stripe.create-payment-intent') }}", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    plan_name: "{{ $selectedPlan['name'] }}",
                    plan_price: {{ $selectedPlan['price'] }}
                }),
            }).then((r) => r.json());
        
            elements = stripe.elements({ clientSecret });
        
            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");
            
        } catch (error) {
            console.error('Error initializing Stripe:', error);
            showMessage("Error loading payment form. Please refresh the page.");
        }
    }
    
    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);
    
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: "{{ route('stripe.success') }}",
            },
        });
    
        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }
    
        setLoading(false);
    }
    
    // ------- UI helpers -------
    
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#payment-message");
    
        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;
        messageContainer.classList.add("error");
    
        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageContainer.textContent = "";
            messageContainer.classList.remove("error");
        }, 4000);
    }
    
    // Show a spinner on payment submission
    function setLoading(isLoading) {
        const submitButton = document.querySelector("#submit");
        const spinner = document.querySelector("#spinner");
        const buttonText = document.querySelector("#button-text");
        
        if (isLoading) {
            // Disable the submit button and show a spinner
            submitButton.disabled = true;
            spinner.classList.add("show");
            buttonText.classList.add("hidden");
        } else {
            submitButton.disabled = false;
            spinner.classList.remove("show");
            buttonText.classList.remove("hidden");
        }
    }
</script>


@include('layouts.admin.footer_new')
