<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumo;
use App\Models\AnaliseCarbono;
use Illuminate\Support\Facades\Auth;

class AnaliseCarbonoController extends Controller
{
    public function calcular(Request $request)
    {
        $dataReferencia = $request->input('data_referencia');

        if (!$dataReferencia || !strtotime($dataReferencia)) {
            return back()->with('error', 'Data de referência inválida ou ausente.');
        }

        // Completar o dia caso venha só ano-mês (formato YYYY-MM)
        if (strlen($dataReferencia) === 7) {
            $dataReferencia .= '-01'; // adiciona o dia 01 para ficar no formato YYYY-MM-DD
        }

        $empresaId = Auth::user()->empresa_id;

        $mes = date('m', strtotime($dataReferencia));
        $ano = date('Y', strtotime($dataReferencia));

        $consumos = Consumo::with('fonteConsumo')
            ->where('empresa_id', $empresaId)
            ->whereMonth('data_referencia', $mes)
            ->whereYear('data_referencia', $ano)
            ->get();

        if ($consumos->isEmpty()) {
            return back()->with('error', 'Nenhum consumo encontrado para o mês e empresa informados.');
        }

        $totalEmissaoGramas = 0;
        $detalhes = [];

        foreach ($consumos as $consumo) {
            $fatorEmissao = $consumo->fonteConsumo->fator_emissao ?? 0;
            $emissao = $consumo->quantidade_consumida * $fatorEmissao;
            $totalEmissaoGramas += $emissao;

            $detalhes[] = [
                'fonte' => $consumo->fonteConsumo->nome,
                'quantidade' => $consumo->quantidade_consumida,
                'fator_emissao' => $fatorEmissao,
                'emissao_g_co2e' => $emissao,
            ];
        }

        $totalEmissaoKg = $totalEmissaoGramas / 1000;

        $analise = AnaliseCarbono::create([
            'empresa_id' => $empresaId,
            'data_referencia' => $dataReferencia,
            'emissao_total_kgco2e' => $totalEmissaoKg,
            'detalhes_json' => json_encode($detalhes),
            'data_calculo' => now(),
        ]);

        return back()->with('success', "Cálculo realizado com sucesso! Emissão total: {$totalEmissaoKg} kgCO2e.");
    }
}
