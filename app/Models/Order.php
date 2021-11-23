<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'monto',
    ];

    /**
     * Obtener los datos del usuario que hizo la orden.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el estatus de la orden.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($order) 
        {
            $order->numero_orden = Order::generar_numero();
            $order->estado_id = 4;
        });
    }

    protected function generar_numero()
    {
        $consulta_ultimo_numero = Order::latest('numero_orden')->first();
        $nuevo_numero = $consulta_ultimo_numero ? (int) $consulta_ultimo_numero->numero_orden+1 : 1;
        $formato_numero = str_pad($nuevo_numero, 10,0,STR_PAD_LEFT);
        return $formato_numero;
    }
}
