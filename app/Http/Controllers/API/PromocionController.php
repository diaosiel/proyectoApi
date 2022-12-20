<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Muestra todas las promociones existente 
    public function index()
    {
        $promocion=Promocion::orderBy('id','desc')->get();
        return $promocion;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promocion=new Promocion();


        $promocion->nombre=$request->nombre;
        $promocion->descripcion=$request->descripcion;
        $promocion->precioDolar=$request->precioDolar;

        if($request->hasFile("foto")){
         $foto=$request->file("foto");
         $nombreimagen= Str::slug($request->nombre).".".$foto->guessExtension();
         $ruta =public_path ( "img/fotos/" );
         $foto->move($ruta,$nombreimagen);
         $promocion->foto=$nombreimagen;
       


        }
        $promocion->save();
        return response()->json([
            'res'=> true,
            'msg'=>'Prodcuto Guardado Correctamente'
            
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Promocion $promocion)
    {
        //
        $url_imagen=public_path()."/img/fotos/".$promocion->foto;
    
       unlink($url_imagen);
       $promocion->delete();
       
     return response()->json([
        'res'=>true,
        'mensaje'=>"Producto Eliminado  Correctamente"

      ],200);
    }
}
