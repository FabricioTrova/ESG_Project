<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumo;
use App\Models\AnaliseCarbono;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnaliseCarbonoController extends Controller{
    public function calcular(Request $request){
    $dataInicio = $request->input('data_inicio');
    $dataFim = $request->input('data_fim');

    if (!$dataInicio || !$dataFim || !strtotime($dataInicio) || !strtotime($dataFim)) {
        return back()->with('error', 'Datas inválidas.');
    }

    if (strtotime($dataInicio) > strtotime($dataFim)) {
        return back()->with('error', 'A data de início deve ser anterior à data de fim.');
    }

    $empresaId = Auth::user()->empresa_id;

    $consumos = Consumo::with('fonteConsumo')
        ->where('empresa_id', $empresaId)
        ->whereBetween('data_referencia', [$dataInicio, $dataFim])
        ->get();

    if ($consumos->isEmpty()) {
        return back()->with('error', 'Nenhum consumo encontrado para o período.');
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

    AnaliseCarbono::create([
        'empresa_id' => $empresaId,
        'data_referencia' => $dataInicio, // Usa data_inicio como referência
        'emissao_total_kgco2e' => $totalEmissaoKg,
        'detalhes_json' => json_encode($detalhes),
        'data_calculo' => now(),
    ]);

    return back()->with('success', "Cálculo realizado! Emissão total: {$totalEmissaoKg} kgCO2e.");
}

    public function dados(Request $request){
    $empresaId = Auth::user()->empresa_id;
    $dataInicio = $request->input('data_inicio');
    $dataFim = $request->input('data_fim');
    $query = AnaliseCarbono::where('empresa_id', $empresaId);
    if ($dataInicio && $dataFim) {
        $query->whereBetween('data_referencia', [$dataInicio, $dataFim]);
    }
    $analises = $query->orderBy('data_referencia')->get(['data_referencia', 'emissao_total_kgco2e']);
    $labels = [];
    $valores = [];
    foreach ($analises as $analise) {
        $labels[] = date('d/m/Y', strtotime($analise->data_referencia));
        $valores[] = $analise->emissao_total_kgco2e;
    }
    \Log::info('Dados do gráfico:', ['labels' => $labels, 'valores' => $valores, 'empresa_id' => $empresaId, 'data_inicio' => $dataInicio, 'data_fim' => $dataFim]);

    return response()->json([
        'labels' => $labels,
        'valores' => $valores,
    ]);
}
public function emissaoPorFonte(Request $request){
        $empresaId = Auth::user()->empresa_id;  // Pega a empresa do usuário autenticado
        $analises = DB::table('analises_carbono')
            ->where('empresa_id', $empresaId)
            ->select('detalhes_json')
            ->get();
        $agregado = [];
        foreach ($analises as $analise) {
            $detalhes = json_decode($analise->detalhes_json, true);
            foreach ($detalhes as $item) {
                $fonte = $item['fonte'];
                $emissao = $item['emissao_g_co2e'];
                if (!isset($agregado[$fonte])) {
                    $agregado[$fonte] = 0;
                }
                $agregado[$fonte] += $emissao;
            }
        }
        return response()->json($agregado);
    }
}