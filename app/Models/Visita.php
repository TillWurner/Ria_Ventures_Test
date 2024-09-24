<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cliente_nombre',
        'cliente_telefono',
        'cliente_email',
        'forma_contacto',
        'estado_visita',
        'referencia',
        'link',
        'latitud',
        'longitud',
        'fecha_visita',
    ];

    // Definir la relación con el modelo User (ejecutivo de ventas)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
