<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $fillable = ['orden_fecha', 'cliente_id', 'user_id'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'orden_producto')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
