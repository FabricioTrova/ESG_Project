<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index()
    {
        // ALTERAÇÃO: Corrigido o nome da variável para 'registros'
        $registros = DB::table('registro_esg')->get();
        // ALTERAÇÃO: Ajustado o nome da view para corresponder à rota /history
        return view('history', compact('registros'));
    }

    public function store(Request $request)
    {
        // ALTERAÇÃO: Adicionada validação para os campos esperados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:255',
            'personalidade' => 'required|string|max:255',
        ]);

        // ALTERAÇÃO: Adicionado created_at para consistência com a view
        DB::table('registro_esg')->insert([
            'nome' => $validated['nome'],
            'tipo' => $validated['tipo'],
            'nacionalidade' => $validated['nacionalidade'],
            'personalidade' => $validated['personalidade'],
            'created_at' => now(),
        ]);

        // ALTERAÇÃO: Ajustada a resposta JSON para corresponder ao script da view
        return response()->json(['message' => 'Registro criado com sucesso'], 200);
    }

    // ALTERAÇÃO: Adicionado método edit para suportar links de edição
    public function edit($id)
    {
        $registro = DB::table('registro_esg')->where('id', $id)->first();
        if (!$registro) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
        return view('registro_esg.edit', compact('registro'));
    }

    // ALTERAÇÃO: Adicionado método update para suportar atualizações
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:255',
            'personalidade' => 'required|string|max:255',
        ]);

        $affected = DB::table('registro_esg')->where('id', $id)->update([
            'nome' => $validated['nome'],
            'tipo' => $validated['tipo'],
            'nacionalidade' => $validated['nacionalidade'],
            'personalidade' => $validated['personalidade'],
            'updated_at' => now(),
        ]);

        if ($affected) {
            return response()->json(['message' => 'Registro atualizado com sucesso'], 200);
        }

        return response()->json(['message' => 'Registro não encontrado'], 404);
    }

    // ALTERAÇÃO: Adicionado método destroy para suportar exclusão
    public function destroy($id)
    {
        $affected = DB::table('registro_esg')->where('id', $id)->delete();

        if ($affected) {
            return response()->json(['message' => 'Registro excluído com sucesso'], 200);
        }

        return response()->json(['message' => 'Registro não encontrado'], 404);
    }
}