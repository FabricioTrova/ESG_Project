<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroController extends Controller
{
    public function index()
    {
        // Buscar as opções para o select
        $fontes = DB::table('fontes_consumo')->orderBy('nome')->get();

        // Buscar os registros principais da tabela 'consumos'
        $registros = DB::table('fontes_consumo')
            ->join('fontes_consumo as fc', 'fc.id', '=', 'fontes_consumo.fonte_consumo_id')
            ->select('fontes_consumo.*', 'fc.nome as fonte_nome')
            ->get();

        return view('fonteDeRegistro', compact('registros', 'fontes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fonte_consumo_id' => 'required|integer|exists:fontes_consumo,id',
            'quantidade_consumida' => 'required|numeric|min:0',
            'fator_emissao' => 'required|numeric|min:0',
            'data_registro' => 'required|date',
        ]);

        try {
            $empresa_id = 1; // Substitua com base no usuário autenticado, se necessário

            DB::table('fontes_consumo')->insert([
                'empresa_id' => $empresa_id,
                'fonte_consumo_id' => $validated['fonte_consumo_id'],
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'data_registro' => $validated['data_registro'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao salvar o registro: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fonte_consumo_id' => 'required|integer|exists:fontes_consumo,id',
            'quantidade_consumida' => 'required|numeric|min:0',
            'data_registro' => 'required|date',
        ]);

        try {
            DB::table('fontes_consumo')->where('id', $id)->update([
                'fonte_consumo_id' => $validated['fonte_consumo_id'],
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'data_registro' => $validated['data_registro'],
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('consumos')->where('id', $id)->delete();
            return redirect()->route('registros.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o registro: ' . $e->getMessage()]);
        }
    }
}
