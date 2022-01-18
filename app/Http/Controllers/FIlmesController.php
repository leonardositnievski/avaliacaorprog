<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmesController extends Controller
{


    public function index(){ // Listagem de filmes
        return view('home')->with(['filmes' => Filme::orderBy('nome')->get()]);
    }

    public function show($id){ // Visualização indiviudal
        return view('filme.view')->with('filme', Filme::findOrFail($id));
    }


    public function store(Request $request){
        $form = $request->validate([
            'image' => 'max:400000|mimes:jpg,png,jpeg|required|image',
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'trailer_link' => 'required|string|regex:/https:\/\/www.youtube.com\/watch\\?v=(.+)/i',
            'genero' => 'required|string'
        ]);

        
        $filme = Filme::inserir($form['image'], $form); //Toda a logica esta aqui dentro

        return redirect()->route('item', ['id' => $filme->id]);
    }




    public function foto($url){
        $filme = Filme::where('foto_url', $url)->first();
        if(!$filme){
            return response('', 404);
        }
        
        $miniatura = $filme->photo_contents;
        
        return response($miniatura)
                ->header('Content-Type','image/jpg')
                ->header('Content-Lenght' , strlen($miniatura));
    }


}
