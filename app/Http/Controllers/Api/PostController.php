<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //richiamo tutti i post, gestendo anche le categorie e creando un impaginazione da 6
        $posts = Post::with(['category', 'tags'])->paginate(6);

        //ritorno un file Json che poi passerĂ² al Front
        return response()->json(
            [
                'result' => $posts,
                'success'=> true
            ]
        );
    }

   
}
