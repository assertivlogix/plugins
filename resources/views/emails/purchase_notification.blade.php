@component('mail::message')
# New Purchase Notification

A new purchase has been made on your platform.

## Customer Information
**Name:** {{ $user->name }}  
**Email:** {{ $user->email }}  
**Phone:** {{ $user->phone ?? 'Not provided' }}

## Purchase Details
**Product:** {{ $product->name }}  
**Plan:** {{ ucfirst($subscription->plan) }}  
**Amount:** ${{ number_format($subscription->amount, 2) }}  
**Date:** {{ $subscription->created_at->format('F d, Y h:i A') }}  
**Transaction ID:** {{ $subscription->stripe_payment_intent_id ?? 'N/A' }}

## License Information
**License Key:** {{ $license->license_key }}  
**Activation Limit:** {{ $license->activation_limit }}

## Subscription Period
**Start Date:** {{ $subscription->starts_at->format('F d, Y') }}  
**End Date:** {{ $subscription->expires_at->format('F d, Y') }}

---

This is an automated notification from your sales system.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

