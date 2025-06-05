<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable{
    use Notifiable;
    protected $table = 'usuarios';
    protected $fillable = [
        'nome',
        'email',
        'senha_hash',
        'empresa_id',
        'tipo_usuario',
    ];
    protected $hidden = [
        'senha_hash',
    ];
    public $timestamps = false;
    public function empresa(){
    return $this->belongsTo(Empresa::class);
    }

}
