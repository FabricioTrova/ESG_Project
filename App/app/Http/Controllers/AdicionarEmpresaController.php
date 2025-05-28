<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdicionarEmpresaController extends Controller
{
    // Mostra o formulário e lista empresas
    public function index()
    {
        $empresas = DB::table('empresas')->get();
        return view('adicionarempresa', compact('empresas'));
    }

    // Processa o formulário (POST)
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20',
            'setor_atividade' => 'required|string|max:100',
            'endereco' => 'required|string|max:255',
        ]);

        // Remove caracteres especiais do CNPJ, se necessário
        $cnpj = preg_replace('/[^0-9]/', '', $validated['cnpj']);

        // Verifica se o CNPJ já existe
        $existe = DB::table('empresas')->where('cnpj', $cnpj)->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'Este CNPJ já está cadastrado.');
        }

        // Inserção usando Query Builder
        DB::table('empresas')->insert([
            'nome' => $validated['nome'],
            'cnpj' => $cnpj,
            'setor_atividade' => $validated['setor_atividade'],
            'endereco' => $validated['endereco'],
            'data_cadastro' => now(),
        ]);

        return redirect()->back()->with('success', 'Empresa cadastrada com sucesso!');
    }
// Atualiza uma empresa (PUT)
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20',
            'setor_atividade' => 'required|string|max:100',
            'endereco' => 'required|string|max:255',
        ]);

        // Remove caracteres especiais do CNPJ, se necessário
        $cnpj = preg_replace('/[^0-9]/', '', $validated['cnpj']);

        // Verifica se o CNPJ já existe em outra empresa
        $existe = DB::table('empresas')
            ->where('cnpj', $cnpj)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('error', 'Este CNPJ já está cadastrado em outra empresa.');
        }

        // Atualiza a empresa
        DB::table('empresas')
            ->where('id', $id)
            ->update([
                'nome' => $validated['nome'],
                'cnpj' => $cnpj,
                'setor_atividade' => $validated['setor_atividade'],
                'endereco' => $validated['endereco'],
            ]);

        return redirect()->back()->with('success', 'Empresa atualizada com sucesso!');
    }
    // Excluir empresa
    public function destroy($id)
    {
        DB::table('empresas')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Empresa excluída com sucesso!');
    }
}


