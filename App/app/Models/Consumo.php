<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $table = 'consumos';

    protected $fillable = [
        'empresa_id',
        'fonte_consumo_id',
        'data_referencia',
        'quantidade_consumida',
    ];

    public $timestamps = false; // Se sua tabela não tiver created_at / updated_at

    public function fonteConsumo()
    {
        return $this->belongsTo(FonteConsumo::class, 'fonte_consumo_id');
    }
}
