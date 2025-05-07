<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6|confirmed',
            'empresa_nome' => 'required|string|max:255',
            'empresa_cnpj' => 'required|string|max:18|unique:empresas,cnpj',
        ]);

        $empresa = Empresa::create([
            'nome' => $request->empresa_nome,
            'cnpj' => $request->empresa_cnpj,
        ]);

        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha_hash' => Hash::make($request->senha),
            'empresa_id' => $empresa->id,
            'tipo_usuario' => 'admin',
        ]);

        return redirect('/login')->with('success', 'Conta registrada com sucesso!');
    }
}
