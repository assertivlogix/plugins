@component('mail::message')
# New Contact Form Submission

You have received a new message from your contact form.

## Contact Information
**Name:** {{ $name }}  
**Email:** {{ $email }}  
**Subject:** {{ $subject }}

## Message
@component('mail::panel')
{{ $message }}
@endcomponent

---

You can reply directly to this email to respond to {{ $name }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

