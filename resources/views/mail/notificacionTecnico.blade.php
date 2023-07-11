@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
        @endcomponent
    @endslot
{{-- Body --}}
# Hola {{ $tecnico }}, se te ha asignado un nuevo ticket con ID {{ $idTicket }}.

Favor de ingresar al sistema para darle seguimiento.

@component('mail::button', ['url' => config('app.url')])
    Ingresar
@endcomponent

Saludos.
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
        @endcomponent
    @endslot
@endcomponent


