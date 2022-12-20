<?php

use App\Http\Controllers\API\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdEditarProductoController;
use App\Http\Controllers\API\PromocionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
  //OK Muestra de todos los productos que hay en la base de datos//
Route::get('productos',[ProductoController::class,'index']);

 /* OK  Para guradar productos en la base de datos   */
Route::post('productos',[ProductoController::class,'store']);

/* OK RUTA PARA HACER EL FILTRADO POR PROVINCIAS*/ 
Route::get('productos/provincia/{provincia}',[ProductoController::class,'show']);

Route::get('producto/{id}',[ProductoController::class,'edit']);


/*RUTA PARA ACTUALIZAR LOS PRODUCTOS */
Route::post('product/{id}',[ProductoController::class,'update']);

/*OK Ruta PARA ELIMINAR LOS PRODUCTOS */
Route::delete('productos/{producto}',[ProductoController::class,'destroy']);
/* productos carrito */
Route::post('productos/{id}/carrito',[ProductoController::class,'carrito']);


/* RUTAS DE PROMOCIONES  */

//MOSTRAR PROMOCIONES EXISTENTE
Route::get('promocion', [PromocionController::class, 'index']);

 /* OK  Para guradar  en la base de datos   */
 Route::post('promocion',[PromocionController::class,'store']);

 /*Elimar una promocion */

 Route::delete('promocion/{promocion}',[PromocionController::class,'destroy']);
   /* OK Ruta para registrar   */ 
   Route  ::  post  (  'registrar'  , [  UserController  ::class,  'registrar'  ]); 
   Route  ::  post  (  'login'  ,[  UserController  ::class,  'login'  ]); 
 
  /* OK Ruta para registrar   */
  Route::post('register',[UserController::class,'register']);
  Route::post('login',[UserController::class,'login']);

  Route::group(['middleware'=>["auth:sanctum"]], function(){
    Route::get('user-profile',[UserController::class,'userProfile']);
    Route::get('logout',[UserController::class,'logout']);
    Route::get('productos',[ProductoController::class,'index']);
  }); 