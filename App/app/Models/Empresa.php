<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'cnpj', 'setor_atividade', 'endereco'];

    public function usuarios(){
        return $this->hasMany(Usuario::class);
    }
}
