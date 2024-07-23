@extends('mails.base_mails')
@section('content')
    <p> Hola {{ $full_name }} !!</p>
    <p>
        ¡Tenemos una emocionante noticia para compartir con todos ustedes! Este {{ $dia_evento }} , 
        en {{ $location }}, estaremos llevando a cabo un maravilloso evento de adopción animal, y nos encantaría contar con tu presencia. 
    </p>
    
@endsection