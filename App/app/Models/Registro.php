<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registro_esg';
    protected $fillable = ['tipo', 'quantidade', 'gasto'];
    public $timestamps = true;
}