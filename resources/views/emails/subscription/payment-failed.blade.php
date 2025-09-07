@component('mail::message')
# Payment Failed - Action Required

Hi {{ $user->name }},

We were unable to process your payment for your Snapshot Albums subscription. Your access to premium features has been temporarily suspended.

## What happened?
Your payment method was declined or expired. This could be due to:
- Insufficient funds
- Expired card
- Bank security restrictions
- Incorrect billing information

## What you need to do:
1. **Update your payment method** by clicking the button below
2. **Verify your billing information** is correct
3. **Contact your bank** if the issue persists

@component('mail::button', ['url' => $updateUrl])
Update Payment Method
@endcomponent

## Important Information:
- **Retry Date**: {{ $retryDate }}
- **Access**: You'll regain full access once payment is successful
- **Data Safety**: Your albums and data are safe and will be restored

## Need Help?
If you're having trouble updating your payment method or have questions, please contact our support team at {{ $supportEmail }}.

Thanks,<br>
The Snapshot Albums Team

---

*This is an automated message. Please do not reply to this email.*
@endcomponent
