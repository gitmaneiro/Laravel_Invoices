<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio'];

    public function orden()
    {
        return $this->belongsToMany(Orden::class, 'orden_producto');
    }
}
