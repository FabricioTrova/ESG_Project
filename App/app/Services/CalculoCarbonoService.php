<?php

namespace App\Services;

use App\Models\Consumo;
use App\Models\AnaliseCarbono;
use Illuminate\Support\Facades\DB;

class CalculoCarbonoService
{
    public function calcularParaEmpresa($empresaId, $dataReferencia)
    {
        // Busca todos os consumos dessa empresa no mês e ano
        $consumos = Consumo::with('fonte')
            ->where('empresa_id', $empresaId)
            ->whereMonth('data_referencia', $dataReferencia->format('m'))
            ->whereYear('data_referencia', $dataReferencia->format('Y'))
            ->get();

        $totalEmissaoKg = 0;
        $detalhes = [];

        foreach ($consumos as $consumo) {
            $fatorEmissao = $consumo->fonte->fator_emissao;

            // Pula se não tiver fator de emissão
            if (is_null($fatorEmissao)) {
                continue;
            }

            // Cálculo: gCO2e → kgCO2e
            $emissaoKg = ($consumo->quantidade_consumida * $fatorEmissao) / 1000;

            $totalEmissaoKg += $emissaoKg;

            $detalhes[] = [
                'fonte' => $consumo->fonte->nome,
                'unidade_medida' => $consumo->fonte->unidade_medida,
                'quantidade' => $consumo->quantidade_consumida,
                'fator_emissao' => $fatorEmissao,
                'emissao_kgco2e' => $emissaoKg,
            ];
        }

        // Grava o resultado na tabela analises_carbono
        $analise = AnaliseCarbono::create([
            'empresa_id' => $empresaId,
            'data_referencia' => $dataReferencia->format('Y-m-d'),
            'emissao_total_kgco2e' => $totalEmissaoKg,
            'detalhes_json' => $detalhes,
        ]);

        return [
            'analise_id' => $analise->id,
            'total_emissao_kgco2e' => $totalEmissaoKg,
            'detalhes' => $detalhes,
        ];
    }
}
