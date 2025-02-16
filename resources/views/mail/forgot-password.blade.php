<x-mail::message>
    {!! __('mails.content.forgot_password', [
        'code' => $code,
        'deadline' => config('auth.verification_code_ttl'),
        ]) . __("mails.footer", ['name' => config('app.name'), 'uri' => config('app.url')]) !!}
</x-mail::message>
