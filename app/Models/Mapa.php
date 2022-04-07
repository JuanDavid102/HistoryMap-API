<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'link_imagen',
        'usuario_id'
    ];

    public function usuarioPropietario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function marcadores()
    {
        return $this->hasMany(Marcador::class, 'mapa_id');
    }
}
