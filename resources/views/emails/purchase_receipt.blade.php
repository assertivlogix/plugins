@component('mail::message')
# Thank You for Your Purchase!

Hi {{ $user->name }},

We appreciate your business. Here are the details of your recent purchase:

**Product:** {{ $subscription->product->name }}  
**Plan:** {{ ucfirst($subscription->plan) }}  
**Amount:** ${{ number_format($subscription->amount / 100, 2) }}  
**Date:** {{ $subscription->created_at->format('F d, Y') }}  

## License Key

You can use the following license key to activate your plugin:

@component('mail::panel')
{{ $license->license_key }}
@endcomponent

@component('mail::button', ['url' => route('licenses')])
Manage Your License
@endcomponent

If you have any questions, feel free to reply to this email or visit our [Support Center]({{ route('support.index') }}).

Thanks,<br>
{{ config('app.name') }}
@endcomponent
