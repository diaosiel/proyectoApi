<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarProductoRequest;
use App\Http\Requests\GuardarProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      // Muestra de todos los productos que hay en la base de datos//
    public function index()
    { 
      
         $producto=Producto::orderBy('id','desc')->get();
         return $producto;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* Para guradar productos en la base de datos   */
    public function store(Request $request)
    {     // se puede validar los datos entrantes 
        $producto=new Producto();
      
        $producto->nombre=$request->nombre;
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->cantidad=$request->cantidad;
        $producto->provincia=$request->provincia;
     //scprit para subir la foto 
     if($request->hasFile("foto")){
          $foto=$request->file("foto");
          $nombreimagen= Str::slug($request->nombre).".".$foto->guessExtension();
          $ruta =public_path ( "img/fotos/" );
          $foto->move($ruta,$nombreimagen);
          $producto->foto=$nombreimagen;
               

     }
     $producto->save(); 
     
          
        return response()->json([
            'res'=> true,
            'msg'=>'Prodcuto Guardado Correctamente'
            
        ],200);

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // es el filtrado por provincias 
    public function show(Request $request)
    {
        
            //eliminlos caracteres extanno
            $provincia=preg_replace('([^A-Za-z0-9])',' ',$request->provincia);
     
        
            //convierte todo a minuscula
            $provincia=strtolower($provincia);
           $producto=Producto::where("provincia",$provincia)->orderBy('id','desc')->get();
    
            return response()->json([
                'res'=>true,
                'producto'=>$producto
            ],200);
       
      
      
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function edit(Request $request){
         $producto=Producto::find($request->id);
             return $producto;
     

     }

    public function update(Request $request)
    {  
        $producto= Producto::find($request->id);
        $producto->nombre=$request->nombre;  
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->cantidad=$request->cantidad;
        $producto->provincia=$request->provincia;

        if($request->hasFile("foto")){
            $foto=$request->file("foto");
            $nombreimagen= $foto->getClientOriginalName();
            
            
            if(strcmp($producto->foto,$nombreimagen)==0){
                 $producto->save();
                 return response()->json([
                    'res'=> true,
                    'msg'=>'Prodcuto Editado Correctamente',
                     
            
                ],200);
            }else{
                $url_imagen=public_path()."/img/fotos/".$producto->foto;;
                unlink($url_imagen);
                if($request->hasFile("foto")){
                    $foto=$request->file("foto");
                    $nombreimagen= $foto->getClientOriginalName();
                    $ruta =public_path ( "img/fotos/" );
                  $foto->move($ruta,$nombreimagen);
                   $producto->foto=$nombreimagen;
                     $producto->save();
                     return response()->json([
                        'res'=> true,
                        'msg'=>'Prodcuto Editado Correctamente',
                         
                
                    ],200);
                
                
                }
                
            }
           
    }
    
     //;
       
    

       /*
       
       
            if(strcmp($producto["foto"],$prod["foto"])==0){
                    return "productos iguales";
                   /*    
                $producto->update($prod);
                return response()->json([
                   'res'=> true,
                   'msg'=>'Prodcuto Editado Correctamente',
                   'producto'=>$producto
               ],200);
          
               }else{
                $url_imagen=public_path()."/img/fotos/".$producto["foto"];;
                unlink($url_imagen);
                
                if($request->hasFile("foto")){
           
                   $foto=$request->file("foto");
                   $nombreimagen= Str::slug($request->nombre).".".$foto->guessExtension();
                   $ruta =public_path( "img/fotos/" );
                   $foto->move($ruta,$nombreimagen);
                   $prod['foto']=$nombreimagen;
                   $producto->update($prod);
                   return response()->json([
                      'res'=> true,
                      'msg'=>'Prodcuto Editado Correctamente',
                      'producto'=>$producto
                  ],200);
               }
                
                */
              
          
           
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
       $url_imagen=public_path()."/img/fotos/".$producto->foto;
    
       unlink($url_imagen);
       $producto->delete();
       
     return response()->json([
        'res'=>true,
        'mensaje'=>"Producto Eliminado  Correctamente"

      ],200);
    }
    public function carrito(Request $request,$id){
        $carrito= Producto::findOrFail($id);

         $carrito->precio=$carrito->precio*$request->cantidad;
         
           return response($request);


    }
}
