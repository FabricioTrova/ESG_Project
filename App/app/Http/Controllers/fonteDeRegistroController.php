<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = DB::table('registros_consumo')
            ->join('fontes_consumo', 'registros_consumo.fonte_consumo_id', '=', 'fontes_consumo.id')
            ->select('registros_consumo.*', 'fontes_consumo.nome as fonte_nome')
            ->get();

        return view('fonteDeRegistro', compact('registros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fonte_consumo' => 'required|string|max:255',
            'quantidade_consumida' => 'required|numeric|min:0',
            'fator_emissao' => 'required|numeric|min:0',
        ]);

        try {
            $empresa_id = 1; // ajuste conforme sua lógica de autenticação

            $fonte_consumo_id = DB::table('fontes_consumo')
                ->where('nome', $validated['fonte_consumo'])
                ->value('id');

            if (!$fonte_consumo_id) {
                $fonte_consumo_id = DB::table('fontes_consumo')->insertGetId([
                    'nome' => $validated['fonte_consumo'],
                    'unidade_medida' => 'Desconhecida',
                    'fator_emissao' => $validated['fator_emissao'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            DB::table('registros_consumo')->insert([
                'empresa_id' => $empresa_id,
                'fonte_consumo_id' => $fonte_consumo_id,
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'fator_emissao' => $validated['fator_emissao'],
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
            'fator_emissao' => 'required|numeric|min:0',
        ]);

        try {
            $fonte_consumo_id = DB::table('fontes_consumo')
                ->where('nome', $validated['fonte_consumo'])
                ->value('id');

            if (!$fonte_consumo_id) {
                $fonte_consumo_id = DB::table('fontes_consumo')->insertGetId([
                    'nome' => $validated['fonte_consumo'],
                    'unidade_medida' => 'Desconhecida',
                    'fator_emissao' => $validated['fator_emissao'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            DB::table('registros_consumo')->where('id', $id)->update([
                'fonte_consumo_id' => $fonte_consumo_id,
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'fator_emissao' => $validated['fator_emissao'],
                'data_registro' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('registros_consumo')->where('id', $id)->delete();
            return redirect()->route('registros.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o registro: ' . $e->getMessage()]);
        }
    }
}
