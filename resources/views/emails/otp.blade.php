@component('mail::message')
# Verifikasi Email

Halo!

Kode OTP kamu adalah:

# **{{ $otp }}**

Kode ini berlaku selama **5 menit**.  
Jangan berikan kode ini ke siapa pun.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
e>
