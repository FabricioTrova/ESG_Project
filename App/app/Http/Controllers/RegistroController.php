<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroController extends Controller
{
    // Exibe todos os registros de consumo junto com os dados da fonte de consumo
    public function index()
    {
        $registros = DB::table('registros_consumo')
            ->join('fontes_consumo', 'registros_consumo.fonte_consumo_id', '=', 'fontes_consumo.id')
            ->select('registros_consumo.*', 'fontes_consumo.nome as fonte_nome')
            ->get();

        // Retorna para a view 'fonteDeConsumo' (onde está o modal) com os registros carregados
        return view('fonteDeConsumo', compact('registros'));
    }

    // Armazena um novo registro de consumo (ação do botão "Cadastrar" do modal)
    public function store(Request $request)
    {
        // Valida os dados enviados pelo formulário
        $validated = $request->validate([
            'fonte_consumo' => 'required|string|max:255',
            'quantidade_consumida' => 'required|numeric|min:0',
            'fator_emissao' => 'required|numeric|min:0',
        ]);

        try {
            $empresa_id = 1; // Pode ser substituído por Auth::user()->empresa_id, se houver autenticação

            // Busca o ID da fonte de consumo pelo nome
            $fonte_consumo_id = DB::table('fontes_consumo')
                ->where('nome', $validated['fonte_consumo'])
                ->value('id');

            // Se não existir, insere a nova fonte de consumo
            if (!$fonte_consumo_id) {
                $fonte_consumo_id = DB::table('fontes_consumo')->insertGetId([
                    'nome' => $validated['fonte_consumo'],
                    'unidade_medida' => 'Desconhecida',
                    'fator_emissao' => $validated['fator_emissao'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            // Insere o registro de consumo
            DB::table('registros_consumo')->insert([
                'empresa_id' => $empresa_id,
                'fonte_consumo_id' => $fonte_consumo_id,
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'fator_emissao' => $validated['fator_emissao'],
                'data_registro' => Carbon::now(),
            ]);

            // Redireciona de volta com mensagem de sucesso
            return redirect()->route('registros.index')->with('success', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, retorna com mensagem de erro
            return redirect()->back()->withErrors(['error' => 'Erro ao salvar o registro: ' . $e->getMessage()]);
        }
    }

    // Atualiza um registro de consumo existente (ação do botão "Editar" do modal)
    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $validated = $request->validate([
            'fonte_consumo' => 'required|string|max:255',
            'quantidade_consumida' => 'required|numeric|min:0',
            'fator_emissao' => 'required|numeric|min:0',
        ]);

        try {
            // Verifica se a fonte de consumo já existe
            $fonte_consumo_id = DB::table('fontes_consumo')
                ->where('nome', $validated['fonte_consumo'])
                ->value('id');

            // Se não existir, cria a nova fonte
            if (!$fonte_consumo_id) {
                $fonte_consumo_id = DB::table('fontes_consumo')->insertGetId([
                    'nome' => $validated['fonte_consumo'],
                    'unidade_medida' => 'Desconhecida',
                    'fator_emissao' => $validated['fator_emissao'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            // Atualiza o registro no banco de dados
            DB::table('registros_consumo')->where('id', $id)->update([
                'fonte_consumo_id' => $fonte_consumo_id,
                'quantidade_consumida' => $validated['quantidade_consumida'],
                'fator_emissao' => $validated['fator_emissao'],
                'data_registro' => Carbon::now(),
            ]);

            // Redireciona com sucesso
            return redirect()->route('registros.index')->with('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de falha
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    // Exclui um registro (ação do botão "Excluir" do modal)
    public function delete($id)
    {
        try {
            // Deleta o registro de consumo
            DB::table('registros_consumo')->where('id', $id)->delete();

            // Redireciona com sucesso
            return redirect()->route('registros.index')->with('success', 'Registro excluído com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o registro: ' . $e->getMessage()]);
        }
    }
}
