<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    protected $fillable=[
    
       'nombre',
       'descripcion',
       'precioDolar',
         'foto'
    ];
    protected $hidden=[
       'created_at',
        'updated_at',
        
    ];
}
