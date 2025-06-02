<?php

namespace App\Models;

use App\Models\Consumo;

class Export
{
    public static function dadosConsumos()
    {
        $consumos = Consumo::with('fonteConsumo')->get();

        return $consumos->map(function ($item) {
            return [
                'Empresa ID'           => $item->empresa_id,
                'Fonte de Consumo'     => optional($item->fonteConsumo)->nome ?? 'N/A',
                'Quantidade Consumida' => $item->quantidade_consumida,
                'Data de Referência'   => $item->data_referencia,
            ];
        })->toArray();
    }
}   
