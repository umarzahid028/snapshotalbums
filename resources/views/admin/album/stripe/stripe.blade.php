@include('layouts.admin.header_new')

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        .bgc-f7{
            background-color:transparent !important;
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
    <h1 style="color: black;">Snapshot Albums Premium - $99/year</h1>
    <p>Complete the payment information below to enable access to <strong>Premium</strong> features.<br>
    Payment is fulfilled securely by Stripe&trade;</p>
    <!-- <form class="form-style1"> -->
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
    @csrf
    <div class="row">
        <div class="col-sm-6 col-xl-12">
            <div class="mb20 required">
                <label class="heading-color ff-heading fw600 mb10">Name on Card</label>
                <input type="text" placeholder="Ex. John Smith" size="4" class="form-control">
            </div>
            <div class="mb20 required">
                <label class="heading-color ff-heading fw600 mb10">Card Number</label>
                <input autocomplete='off' type="text" size="20" class="form-control card-number" maxlength="16">
                <!-- Set maxlength to 16 for a 16-digit card number -->
            </div>
        </div>
        <div class="col-4 mb20 cvc required">
            <label class="heading-color ff-heading fw600 mb10">CVC</label>
            <input type="text" autocomplete='off' placeholder="***" size="3" maxlength="3" class="form-control card-cvc">
            <!-- Set maxlength to 3 for a 3-digit CVC -->
        </div>
        <div class="col-4 mb20 expiration required">
            <label class="heading-color ff-heading fw600 mb10">Expiration Month</label>
            <input type="text" placeholder="MM" size="2" maxlength="2" class="form-control card-expiry-month">
            <!-- Set maxlength to 2 for a 2-digit month (01-12) -->
        </div>
        <div class="col-4 mb20 expiration required">
            <label class="heading-color ff-heading fw600 mb10">Expiration Year</label>
            <input type="text" placeholder="YYYY" size="4" maxlength="4" class="form-control card-expiry-year">
            <!-- Set maxlength to 4 for a 4-digit year (e.g., 2023) -->
        </div>
        <div class="col-md-12">
            <div class="text-end">
                <button class="ud-btn btn-thm" type="submit">Pay Now ($99)<i class="fal fa-arrow-right-long"></i></button>
            </div>
        </div>
    </div>
</form>

</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessageContainer = $form.find('.error-message-container'), // Updated error message container selector
                $errorMessage = $form.find('.error-message'),
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
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
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