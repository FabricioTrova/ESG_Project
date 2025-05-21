<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FonteConsumo;

class FonteConsumoController extends Controller
{
    public function index()
    {
        $fontes = FonteConsumo::all();
        return view('fonteDeConsumo', compact('fontes')); // <-- view padrão ajustada
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'unidade_medida' => 'required|string|max:50',
            'fator_emissao' => 'nullable|numeric|min:0',
        ]);

        try {
            FonteConsumo::create([
                'nome' => $validated['nome'],
                'unidade_medida' => $validated['unidade_medida'],
                'fator_emissao' => $validated['fator_emissao'] ?? null,
            ]);

            return redirect()->route('fontes.index')->with('success', 'Fonte cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao salvar o registro: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'unidade_medida' => 'required|string|max:50',
            'fator_emissao' => 'nullable|numeric|min:0',
        ]);

        try {
            $fonte = FonteConsumo::findOrFail($id);

            $fonte->update([
                'nome' => $validated['nome'],
                'unidade_medida' => $validated['unidade_medida'],
                'fator_emissao' => $validated['fator_emissao'] ?? null,
            ]);

            return redirect()->route('fontes.index')->with('success', 'Fonte atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o registro: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            FonteConsumo::destroy($id);
            return redirect()->route('fontes.index')->with('success', 'Fonte excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir a fonte: ' . $e->getMessage()]);
        }
    }
}
