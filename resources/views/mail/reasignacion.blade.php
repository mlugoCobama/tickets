@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
        @endcomponent
    @endslot
{{-- Body --}}
# Hola, se esta solicitando la reasignación del ticket con ID  {{$idTicket}}.

El usuario {{$solicitante}}, solicita que se reasigne el ticket,

comentando lo siguiente:

{{$comentarios}}

Para que sea asignado al tecnico: {{$tecnicoAsignado}}

del area: {{$area}}

@component('mail::button', ['url' => config('app.url').'/confirmar-reasignacion/'.$idReasignacion])
    Confirmar reasingnación
@endcomponent

Saludos.
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
        @endcomponent
    @endslot
@endcomponent

