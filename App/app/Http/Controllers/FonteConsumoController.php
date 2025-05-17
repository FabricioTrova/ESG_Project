<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FonteConsumoController extends Controller
{
    public function index() {
    $fontes = FonteConsumo::all();
    return view('fontes.index', compact('fontes'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|integer|exists:fontes_consumo,id',
            'unidade_medida' => 'required|numeric|min:0',
            'fator_emissao' => 'required|numeric|min:0',
        ]);

        try {
            $empresa_id = 1; // Substitua com base no usuário autenticado, se necessário

            DB::table('fontes_consumo')->insert([
                'empresa_id' => $empresa_id,
                'nome' => $validated['nome'],
                'unidade_medida' => $validated['unidade_medida'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('fontes.index')->with('success', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao salvar o registro: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|integer|exists:fontes_consumo,id',
            'unidade_medida' => 'required|numeric|min:0',
            'fator_emissao' => 'required|numeric|min:0',
        ]);
        try {

            DB::table('fontes_consumo')->insert([
                'empresa_id' => $empresa_id,
                'nome' => $validated['nome'],
                'unidade_medida' => $validated['unidade_medida'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('fontes.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('fontes_consumo')->where('id', $id)->delete();
            return redirect()->route('fontes.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o registro: ' . $e->getMessage()]);
        }
    }
}
