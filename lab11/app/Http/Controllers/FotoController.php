<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Comentario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Image\Facades\Image;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Illuminate\Http\UploadedFile;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $fotos = Foto::where('user_id',$id)->get();
        return view('fotos', compact('fotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarFoto(string $ruta)
    {
        $file = Storage::disk('public')->get($ruta);
        return Image::make($file)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subirFoto(Request $request)
    {
        if ($request->hasFile('foto')){
            $id = auth()->user()->id;
            


            $image = $request->file('foto');
            $fileName = $image->hashName();
            $image->store('/public/fotos');
            
            $foto = new Foto;
            $foto->user_id = $id;
            $foto->descripcion = $request->descripcion;
            $foto->estado = 1;
            $foto->ruta = $fileName;
            $foto->save();
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarFoto(Request $request)
    {
        if ($request->id_foto){
            $foto = Foto::find($request->id_foto);
            $foto->delete();

            //Storage::disk('fotos')->delete($foto->ruta);
            return redirect('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subirComentario(Request $request)
    {
        if ($request->comentario){
            $id = auth()->user()->id;
            $comentario = new Comentario;
            $comentario->user_id = $id;
            $comentario->foto->id = $request->id_foto;
            $comentario->comentario = $request->comentario;
            $comentario->estado = 1;
            $comentario->save();
            return redirect('home');
        }
    }
    










    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
