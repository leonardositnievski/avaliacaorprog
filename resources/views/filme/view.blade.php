@extends('templates.base')
@section('title', $filme->nome)
@section('h1', $filme->nome)

@section('content')

@push('css')
    
    <style>

        img{
            max-width: 50%;
        }
        
    </style>


@endpush

<img src="{{$filme->url}}">

<p>Genero : {{$filme->genero}}</p>
<p>{{$filme->descricao}}</p>
<p><a href='{{$filme->trailer_link}}'>Trailer</a></p>



@endsection