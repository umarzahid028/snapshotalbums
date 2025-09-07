@component('mail::message')
# Subscription Cancelled

Hi {{ $user->name }},

Your Snapshot Albums subscription has been cancelled as requested. We're sorry to see you go!

## What happens next?
- **Access Until**: {{ $accessEndDate }}
- **Data Safety**: Your albums and data will remain accessible until {{ $accessEndDate }}
- **No Further Charges**: You won't be charged for future billing periods

## Still have access to:
- View and download existing albums
- Export your data
- Basic features until {{ $accessEndDate }}

## Changed your mind?
If you'd like to reactivate your subscription, you can do so anytime before {{ $accessEndDate }}:

@component('mail::button', ['url' => $reactivateUrl])
Reactivate Subscription
@endcomponent

## We'd love your feedback
Help us improve by sharing why you cancelled:
- Found a better solution
- Pricing concerns
- Technical issues
- Other reasons

## Thank you
Thank you for being a valued Snapshot Albums customer. We hope to serve you again in the future!

Best regards,<br>
The Snapshot Albums Team

---

*This is an automated message. Please do not reply to this email.*
@endcomponent
