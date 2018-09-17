@component('mail::message')
# Email confirmation
message

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_code])])
verify email
    vendor/mail
@endcomponent
@endcomponent

