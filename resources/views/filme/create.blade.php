@extends('templates.base')
@section('title', 'Upload')
@section('h1', 'Upload de imagens')

@section('content')

@push('css')
    <style>
        form{
            display: flex;
            flex-direction: column;
            padding-bottom: 3em;
        }

        input{
            width: 50ch;
            border-radius: 5px;
            border: 1px solid black;
            padding: 0.5em 1em
        }

        input[type='submit']{
            background: none;
            border: 0;
            width: 25ch;
            padding: 1em;
            border-radius: 5px;
            background-color:rgb(90, 216, 58);
            color: rgba(0, 0, 0, 0.781);
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);

            font-weight: bold;
            text-transform: uppercase;
        }
        .image-preview{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 45ch;
            width: 45ch;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            
        }
        .image-preview .bi-camera{
            font-size: 5em
        }

        .image-preview.active{
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain
        }
        
        .image-preview.active .bi-camera{
            opacity: 0;
        }
        #image{
            position: absolute;
            left: -99999;
            opacity: 0;
            pointer-events: none;
        }
    </style>
@endpush


{{ Form::open(['route' => 'upload', 'files' => true, 'method' => 'POST']) }}
<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    <label for="nome">Nome</label>
    <input type="text" name='nome' id='nome' value="{{old('nome')}}">
    @error('nome')
        <p class='error'>{{$message}}</p>
    @enderror
    <br />

    <label for="descricao">Descrição</label>
    <input type="text" name='descricao' id='descricao' value="{{old('descricao')}}">
    @error('descricao')
        <p class='error'>{{$message}}</p>
    @enderror
    <br />
    

    <label for="genero">Genero</label>
    <input type="text" name='genero' id='genero' value="{{old('genero')}}">
    @error('genero')
        <p class='error'>{{$message}}</p>
    @enderror
    <br />

    <label for="trailer_link">Link do trailer (youtube)</label>
    <input type="text" name='trailer_link' id='trailer_link' value="{{old('trailer_link')}}">
    @error('trailer_link')
        <p class='error'>{{$message}}</p>
    @enderror
    <br />
    
    <label for="image" class='image-preview'>
        <i class="bi bi-camera"></i>
    </label>
    @error('image')
        <p class='error'>{{$message}}</p>
    @enderror
    <input type="file" name='image' id='image'>

    <br />

    <input type="submit"/>


</form>

@push('scripts')

<script>
    
    document.addEventListener('DOMContentLoaded', ()=>{
        document.getElementById('image').addEventListener('change', (e)=>{
            const [file] = e.target.files;

            if (file) {
                document.querySelector('.image-preview').style.backgroundImage = "url("+URL.createObjectURL(file)+")"
                document.querySelector('.image-preview').classList.add('active')
            }
        })
    })


</script>


@endpush    

@endsection