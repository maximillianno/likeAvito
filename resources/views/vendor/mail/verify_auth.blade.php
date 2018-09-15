@component('mail::message')
# Email confirmation
message

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
verify email
    vendor/mail
@endcomponent
@endcomponent

