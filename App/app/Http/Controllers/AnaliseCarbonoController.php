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

    public function dados()
    {
        $empresaId = Auth::user()->empresa_id;

        $analises = AnaliseCarbono::where('empresa_id', $empresaId)
                    ->orderBy('data_referencia')
                    ->get(['data_referencia', 'emissao_total_kgco2e']);

        $labels = [];
        $valores = [];

        foreach ($analises as $analise) {
            $labels[] = date('m/Y', strtotime($analise->data_referencia));
            $valores[] = $analise->emissao_total_kgco2e;
        }

        return response()->json([
            'labels' => $labels,
            'valores' => $valores,
        ]);
    }

    public function dadosPorCategoria()
    {
        $empresaId = Auth::user()->empresa_id;

        // Pega a última análise de carbono da empresa
        $ultimaAnalise = AnaliseCarbono::where('empresa_id', $empresaId)
            ->orderBy('data_referencia', 'desc')
            ->first();

        if (!$ultimaAnalise) {
            return response()->json([
                'labels' => [],
                'valores' => []
            ]);
        }

        $detalhes = json_decode($ultimaAnalise->detalhes_json, true);

        // Agregar emissões por categoria somando valores iguais
        $somaPorCategoria = [];

        foreach ($detalhes as $item) {
            $categoria = $item['fonte'] ?? 'Outros';
            $emissaoKg = ($item['emissao_g_co2e'] ?? 0) / 1000;

            if (!isset($somaPorCategoria[$categoria])) {
                $somaPorCategoria[$categoria] = 0;
            }

            $somaPorCategoria[$categoria] += $emissaoKg;
        }

        // Ordenar para manter padrão (opcional)
        ksort($somaPorCategoria);

        return response()->json([
            'labels' => array_keys($somaPorCategoria),
            'valores' => array_map(fn($v) => round($v, 2), array_values($somaPorCategoria))
        ]);
    }
}
