<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = DB::table('consumo')->get();
        return view('history', compact('registros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fonte_consumo' => 'required|string|max:255',
            'quantidade_consumida' => 'required|numeric|min:0',
            'emissoes_co2' => 'required|numeric|min:0',
            'data_referencia' => 'required|date',
            'origem_dado' => 'required|string|max:255',
        ]);

        try {
            $empresa_id = 1; // Ajuste para contexto real (ex.: auth()->user()->empresa_id)

            // Busca ou cria fonte_consumo
            $fonte_consumo_id = DB::table('fontes_consumo')
                ->where('nome', $validated['fonte_consumo'])
                ->value('id');

            if (!$fonte_consumo_id) {
                $fonte_consumo_id = DB::table('fontes_consumo')->insertGetId([
                    'nome' => $validated['fonte_consumo'],
                    'unidade_medida' => 'Desconhecida', // Ajuste conforme necessário
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            DB::table('consumo')->insert([
                'empresa_id' => $empresa_id,
                'fonte_consumo_id' => $fonte_consumo_id,
                'fonte_consumo' => $validated['fonte_consumo'],
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'emissoes_co2' => $validated['emissoes_co2'],
                'data_referencia' => $validated['data_referencia'],
                'origem_dado' => $validated['origem_dado'],
                'data_registro' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao salvar o registro: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fonte_consumo' => 'required|string|max:255',
            'quantidade_consumida' => 'required|numeric|min:0',
            'emissoes_co2' => 'required|numeric|min:0',
            'data_referencia' => 'required|date',
            'origem_dado' => 'required|string|max:255',
        ]);

        try {
            $fonte_consumo_id = DB::table('fontes_consumo')
                ->where('nome', $validated['fonte_consumo'])
                ->value('id');

            if (!$fonte_consumo_id) {
                $fonte_consumo_id = DB::table('fontes_consumo')->insertGetId([
                    'nome' => $validated['fonte_consumo'],
                    'unidade_medida' => 'Desconhecida',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            DB::table('consumo')->where('id', $id)->update([
                'fonte_consumo_id' => $fonte_consumo_id,
                'fonte_consumo' => $validated['fonte_consumo'],
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'emissoes_co2' => $validated['emissoes_co2'],
                'data_referencia' => $validated['data_referencia'],
                'origem_dado' => $validated['origem_dado'],
                'data_registro' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('consumo')->where('id', $id)->delete();
            return redirect()->route('registros.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o registro: ' . $e->getMessage()]);
        }
    }
}