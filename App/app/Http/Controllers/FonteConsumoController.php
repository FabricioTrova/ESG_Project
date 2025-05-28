<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FonteConsumo;
use App\Models\Consumo;
class FonteConsumoController extends Controller
{
    public function index()
    {
        $fontes = FonteConsumo::all();
        return view('fonteDeConsumo', compact('fontes'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->tipo_usuario !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

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
        $user = auth()->user();
        if ($user->tipo_usuario !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

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
        $user = auth()->user();
        if ($user->tipo_usuario !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        try {
    $fonte = FonteConsumo::findOrFail($id);
    $fonte->consumos()->delete(); // deleta consumos vinculados
    $fonte->delete(); // depois deleta a fonte
    return redirect()->route('fontes.index')->with('success', 'Fonte e consumos vinculados excluídos com sucesso!');
} catch (\Exception $e) {
    return redirect()->back()->withErrors(['error' => 'Erro ao excluir a fonte: ' . $e->getMessage()]);
}
    }
}
