@extends('templates.base')
@section('title', 'Home')
@section('h1', 'Filmes')

@section('content')

@push('css')
    <style>

        .wrapper{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 150px));
            gap: 1em
        }
        .image-item{
            min-height: 150px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            border-radius: 5px;
            overflow: hidden;
            padding: 1em
        }
        .image-item a{
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1em;
            color: rgba(0, 0, 0, 0.774);
            text-align: center;
            font-size: 1em;
        }
        .image-item img{
            width: 100%;
        }


    </style>
@endpush


<div class='wrapper'>
    @foreach ($filmes as $filme)
        <div class='image-item'>
            <a href="{{route('item', ['id' => $filme->id])}}">
                <img src="{{$filme->url}}" alt=""/>
                <p>{{$filme->nome}}</p>
                <p>{{$filme->genero}}</p>
            </a>
        </div>

    @endforeach
</div>

@endsection