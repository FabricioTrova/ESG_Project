<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroController extends Controller
{
    public function index()
    {
        //salvando as informações do banco de dados na variavel, busca todos os dados da tabela consumo no banco de dados.
        // Envia esses dados para a view chamada history.
        $registros = DB::table('consumo')->get();
        return view('historico', compact('registros'));
    }

    public function store(Request $request)//Define uma função pública chamada store, que recebe os dados do formulário através da variável
    {
        $validated = $request->validate([// retorna apenas os dados válidos 
            'fonte_consumo' => 'required|string|max:255',
            'Unidade_Medida' => 'required|numeric|min:0',
            'fator_Emissao' => 'required|string|max:255',
        ]);

        try {
            $empresa_id = 1; 

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
                'fator_Emissao' => $validated['fator_Emissao'],
                'data_registro' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao salvar o registro: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)//funcao para atualizar um registro
    {
        $validated = $request->validate([// retorna apenas os dados válidos 
            'fonte_consumo' => 'required|string|max:255',
            'Unidade_Medida' => 'required|numeric|min:0',
            'fator_Emissao' => 'required|string|max:255',
        ]);
        try {
            $fonte_consumo_id = DB::table('fontes_consumo')//tabela fontes_consumo
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

            DB::table('consumo')->insert([
                'empresa_id' => $empresa_id,
                'fonte_consumo_id' => $fonte_consumo_id,
                'fonte_consumo' => $validated['fonte_consumo'],
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'fator_Emissao' => $validated['fator_Emissao'],
                'data_registro' => Carbon::now(),
            ]);

            return redirect()->route('registros.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    public function delete($id)//funçao para deletar as informaçao no banco
    {
        try {
            DB::table('consumo')->where('id', $id)->delete();
            return redirect()->route('registros.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o registro: ' . $e->getMessage()]);
        }
    }
}