@component('mail::message')
# Your Free Trial Ends Soon!

Hi {{ $user->name }},

Your 7-day free trial of Snapshot Albums Premium will end on **{{ $trialEndDate }}**.

## What happens when your trial ends?
- **Access**: You'll lose access to premium features
- **Data**: Your albums will remain safe and accessible
- **Downgrade**: You'll be moved to the free plan (limited albums)

## Continue with Premium?
Don't let your premium features expire! Choose a plan to continue enjoying:

✅ **Unlimited Albums**  
✅ **Advanced Features**  
✅ **Priority Support**  
✅ **Custom Branding**  

@component('mail::button', ['url' => $upgradeUrl])
Choose Your Plan
@endcomponent

## Plan Options:
- **Basic Plan**: $5.99/month - Up to 10 albums
- **Premium Plan**: $9.99/month - Unlimited albums + all features

## Questions?
If you have any questions about our plans or need help choosing, contact us at {{ $supportEmail }}.

Thanks for trying Snapshot Albums!<br>
The Snapshot Albums Team

---

*This is an automated message. Please do not reply to this email.*
@endcomponent
