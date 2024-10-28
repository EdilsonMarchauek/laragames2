<?php

namespace App\Http\Controllers;

use App\Models\Models\Product;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function show()
    {
        //$produto = Product::where('name', 'teste')->get()->first();
        //echo $produto->name;
        //echo $produto->id;

        // $imagem = $produto->imageProduct()->get();

        // foreach ($imagem as $img){
        //     echo "<hr>{$img->image}";
        // }
        
        //$keySearch = 'e';
        //$produtos = Product::where('name', 'LIKE', "%{$keySearch}%")->with('imageProduct')->get();

        $pps = Product::all()->count();
        echo $pps . '<br>';

        $produtos = Product::all();

        foreach($produtos as $produto){

                echo "<b>$produto->name</b>";

                $imagem = $produto->imageProduct;//with já pega os relacionamentos

                foreach ($imagem as $img){
                    echo "<br>{$img->image}";
                }

                echo '<hr>';
        }
    }

    public function insertImage()
    {
        $dataForm = [
            'image' => 'Imagem Teste 4',
        ];

        //Pega o id número 1
        $produto = Product::where('name', 'teste')->get()->first();

        //Precisa informar o $fillable das imagens => protected $fillable = ['name', 'initials'];
        $insertState = $produto->imageProduct()->create($dataForm);

    }
}
