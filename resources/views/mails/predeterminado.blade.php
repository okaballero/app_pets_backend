@extends('mails.base_mails')
@section('content')

    <h1> Tienes un correo urgente:</h1>
    {{ $body_mail }}
@endsection