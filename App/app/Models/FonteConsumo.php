<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FonteConsumo extends Model
{
    protected $table = 'fontes_consumo';

    public $timestamps = false; 

    protected $fillable = [
        'nome',
        'unidade_medida',
        'fator_emissao',
    ];

    public function consumos()
    {
        return $this->hasMany(Consumo::class, 'fonte_consumo_id');
    }
}
