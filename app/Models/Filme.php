<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Filme extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'foto_url',
        'descricao',
        'trailer_link',
        'genero'
    ];


    public static function inserir($imagem, $dados){
        // Joguei toda a logica de inserir para dentro de uma função da model pois faz mais sentido pra mim
        try{
            DB::beginTransaction();

            $path = Str::random(25);
            
            $image = Filme::create([
                'nome' => $dados['nome'],
                'foto_url'=> $path,
                'descricao'=> $dados['descricao'],
                'trailer_link'=> $dados['trailer_link'],
                'genero'=> $dados['genero']
            ]);

            $diretorio_imagens = storage_path('app/images/');
            File::ensureDirectoryExists($diretorio_imagens);

            Image::make($imagem->getPathName())->save($diretorio_imagens.DIRECTORY_SEPARATOR.$path.'.jpg', 80, 'jpg');

            DB::commit();

            return $image;
        }catch(\Exception $e){
            DB::rollBack(); // Garente que o filme não vai ser adicionado no banco de dados se houver qualquer error no upload de imagens
        }
    }

    // Aqui eu uso uma feature muito legal do laravel chamada mutators
    // ela me permite modificar atributos ou ate criar atributos novos quando eles são acessados
    // o laravel entende todas as funções que seguem o padrão get****Attribute como sendo um getter de atributos
    // da model, assim eu consigo retornar a rota ja pronta da imagem quando a view pedir
    public function getUrlAttribute(){ 
        return route('foto',['url' => $this->foto_url]);
    }

    public function getPhotoContentsAttribute(){
        return file_get_contents(storage_path('app/images/'.$this->foto_url.'.jpg'));
    }
}
