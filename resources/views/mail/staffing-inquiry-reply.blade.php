<x-mail::message>
# Hello from Hailerz

{!! nl2br(e($replyMessage)) !!}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
