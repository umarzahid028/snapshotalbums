@include('layouts.admin.header_new')

<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
                <h4 class="title fz17 mb30">CREATE ALBUM</h4>
                <!-- <form class="form-style1"> -->
                        
                <form role="form" action="{{ route('payment.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-xl-12">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Name on Card</label>
                                <input type="text" name="name" placeholder="Ex Eren" class="form-control required" required>
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Card Number</label>
                                <input type="text" name="card-number" placeholder="9883******32" class="form-control card-number required" required>
                            </div>
                        </div>
                        <div class="col-4 mb20">
                            <label class="heading-color ff-heading fw600 mb10">CVC</label>
                            <input type="number" name="cvc" placeholder="***" size="3" class="form-control card-cvc required" required>
                        </div>
                        <div class="col-4 mb20">
                            <label class="heading-color ff-heading fw600 mb10">Expiration Month</label>
                            <input type="text" name="exp-month" placeholder="MM" size="2" class="form-control card-expiry-month required" required>
                        </div>
                        <div class="col-4 mb20">
                            <label class="heading-color ff-heading fw600 mb10">Expiration Year</label>
                            <input type="text" name="exp-year" placeholder="YYYY" size="4" class="form-control card-expiry-year required" required>
                        </div>
                        <div class="col-md-12">
                            <div class="text-end">
                                <button class="ud-btn btn-thm" type="submit">Create<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

              </div>

              <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
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
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
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
