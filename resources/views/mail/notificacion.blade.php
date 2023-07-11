@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
        @endcomponent
    @endslot
        {{-- Body --}}
        # Hola, le estamos dando seguimiento a tu ticket.

        Se ha asignado al tecnico: {{ $tecnico }}

        con en el siguiente estatus: {{ $estatus }}

        comentarios del tecnico:

        {{ $comentario }}

        Favor de no contestar este correo, es solamente informativo.

        Saludos
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
        @endcomponent
    @endslot
@endcomponent
