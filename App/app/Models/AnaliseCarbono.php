<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AnaliseCarbono extends Model
{
    protected $table = 'analises_carbono';
    public $timestamps = false;
    protected $fillable = [
        'empresa_id',
        'data_referencia',
        'emissao_total_kgco2e',
        'detalhes_json',
        'data_calculo',
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
