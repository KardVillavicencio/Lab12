<?php

namespace App\Http\Controllers;
use App\Models\Foto;
use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Soport\Facedes\Storage;
use Illuminate\Image\Facedes\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->user()->id;
        $fotos = Foto::where('user_id',$id)->get();
        return view('foto', compact('fotos'));
    }
}
