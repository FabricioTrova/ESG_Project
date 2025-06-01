<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\FonteConsumo;
use Illuminate\Http\Request;

class ConsumoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->tipo_usuario === 'admin') {
            $consumos = Consumo::with('fonteConsumo')->get();
        } else {
            $consumos = Consumo::with('fonteConsumo')
                ->where('empresa_id', $user->empresa_id)
                ->get();
        }

        $fontes = FonteConsumo::all();
        return view('consumo', compact('consumos', 'fontes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fonte_consumo_id' => 'required|exists:fontes_consumo,id',
            'data_referencia' => 'required|date',
            'quantidade_consumida' => 'required|numeric|min:0',
        ]);

        try {
            $empresa_id = auth()->user()->empresa_id;

            Consumo::create([
                'empresa_id' => $empresa_id,
                'fonte_consumo_id' => $validated['fonte_consumo_id'],
                'data_referencia' => $validated['data_referencia'],
                'quantidade_consumida' => $validated['quantidade_consumida'],
            ]);

            return redirect()->route('consumos.index')->with('success', 'Consumo registrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao registrar consumo: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fonte_consumo_id' => 'required|exists:fontes_consumo,id',
            'data_referencia' => 'required|date', // corrigido aqui
            'quantidade_consumida' => 'required|numeric|min:0',
        ]);

        try {
            $consumo = Consumo::findOrFail($id);
            $user = auth()->user();

            if ($user->tipo_usuario !== 'admin' && $consumo->empresa_id !== $user->empresa_id) {
                abort(403, 'Acesso não autorizado.');
            }

            $consumo->update($validated);

            return redirect()->route('consumos.index')->with('success', 'Consumo atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao atualizar o consumo: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $consumo = Consumo::findOrFail($id);
            $user = auth()->user();

            if ($user->tipo_usuario !== 'admin' && $consumo->empresa_id !== $user->empresa_id) {
                abort(403, 'Acesso não autorizado.');
            }

            $consumo->delete();

            return redirect()->route('consumos.index')->with('success', 'Consumo excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao excluir o consumo: ' . $e->getMessage()]);
        }
    }
}
