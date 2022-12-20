<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; 

class BusacarProvinciaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
      $producto=Producto::find($id);
      return $producto;
    }
}
