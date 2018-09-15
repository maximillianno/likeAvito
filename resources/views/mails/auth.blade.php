@component('mail::message')
# Email confirmation
kuku

@component('mail::button', ['url' => route('register', ['token' => $user->verify_token])])
verify email
@endcomponent
@endcomponent

