<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroCivico extends Model
{
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'horario'];
}
