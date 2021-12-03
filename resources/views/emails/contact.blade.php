@component('mail::message')

<p><b>Usuário</b>:  {{ $user->full_name         }}</p>
<p><b>E-mail</b>:   {{ $user->email             }}</p>
<p><b>Telefone</b>: {{ $user->phone             }}</p>
<p><b>Clínica</b>:  {{ $user->clinic->full_name }}</p>
<p><b>Message</b>:  {{ $msg                     }}</p>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
