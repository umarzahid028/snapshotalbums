@include('layouts.admin.header_new')

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
    </style>
</head>
<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="error-message-container">
    <span class="error-message"></span>
</div>
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
    
    <!-- Hidden field to store plan info -->
    <input type="hidden" name="plan_name" value="{{ $selectedPlan['name'] }}">
    <input type="hidden" name="plan_price" value="{{ $selectedPlan['price'] }}">
    
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
                <div id="spinner" class="spinner hidden"></div>
            </button>
        </div>
        
        <div id="payment-message" class="hidden"></div>
    </form>

</div>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        var $errorMessageContainer = $form.find('.error-message-container');
        var $errorMessage = $form.find('.error-message');
        var $submitButton = $form.find('button[type="submit"]');

        // Real-time card number validation
        $('.card-number').on('input', function() {
            var cardNumber = $(this).val().replace(/\s/g, '');
            var $indicator = $('.card-type-indicator');
            
            if (cardNumber.length >= 13) {
                // Basic card type detection
                if (cardNumber.startsWith('4')) {
                    $indicator.text('✓ Visa');
                    $(this).removeClass('invalid-card').addClass('valid-card');
                } else if (cardNumber.startsWith('5') || cardNumber.startsWith('2')) {
                    $indicator.text('✓ Mastercard');
                    $(this).removeClass('invalid-card').addClass('valid-card');
                } else if (cardNumber.startsWith('3')) {
                    $indicator.text('✓ American Express');
                    $(this).removeClass('invalid-card').addClass('valid-card');
                } else {
                    $indicator.text('Unknown card type');
                    $(this).removeClass('valid-card').addClass('invalid-card');
                }
            } else {
                $indicator.text('');
                $(this).removeClass('valid-card invalid-card');
            }
        });

        // Real-time CVC validation
        $('.card-cvc').on('input', function() {
            var cvc = $(this).val();
            if (cvc.length >= 3) {
                $(this).removeClass('invalid-card').addClass('valid-card');
            } else {
                $(this).removeClass('valid-card invalid-card');
            }
        });

        // Real-time expiration validation
        $('.card-expiry-month, .card-expiry-year').on('input', function() {
            var month = $('.card-expiry-month').val();
            var year = $('.card-expiry-year').val();
            
            if (month && year) {
                var currentDate = new Date();
                var currentYear = currentDate.getFullYear();
                var currentMonth = currentDate.getMonth() + 1;
                
                if (parseInt(year) > currentYear || (parseInt(year) == currentYear && parseInt(month) >= currentMonth)) {
                    $('.card-expiry-month, .card-expiry-year').removeClass('invalid-card').addClass('valid-card');
                } else {
                    $('.card-expiry-month, .card-expiry-year').removeClass('valid-card').addClass('invalid-card');
                }
            }
        });

        $('form.require-validation').bind('submit', function(e) {
            var inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            valid = true;

            // Clear previous error messages
            $errorMessageContainer.addClass('hide');
            $errorMessage.text('');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessageContainer.removeClass('hide');
                    $errorMessage.text('Please fill in all required fields.');
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault();
                return false;
            }

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                
                // Show loading state
                $submitButton.prop('disabled', true).text('Processing...');
                $form.addClass('loading');
                
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            // Remove loading state
            $submitButton.prop('disabled', false).text('Pay Now ({{ $priceDisplay }})');
            $form.removeClass('loading');
            
            if (response.error) {
                // Display the Stripe error message
                $errorMessage.text(response.error.message);
                $errorMessageContainer.removeClass('hide');
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>


@include('layouts.admin.footer_new')