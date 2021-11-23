<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * Obtener los datos del articulo comprado.
     */
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
