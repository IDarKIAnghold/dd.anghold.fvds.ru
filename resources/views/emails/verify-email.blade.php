<x-mail::message>
# Подтверждение адреса электронной почты
Пожалуйста, нажмите кнопку ниже, чтобы подтвердить свой адрес электронной почты.
<x-mail::button :url="$url" color="success">
Подтвердить Почту
</x-mail::button>
Спасибо, {{ config('app.name') }}
</x-mail::message>
