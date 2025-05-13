<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function showUserForm()
{
    $empresas = Empresa::all();
    return view('auth.register-user', compact('empresas'));
}

public function registrarUsuario(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email',
        'senha' => 'required|min:6|confirmed',
        'empresa_id' => 'required|exists:empresas,id',
        'tipo_usuario' => 'required|in:admin,gestor,colaborador', // <-- Adicione essa linha
    ]);
    
    Usuario::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'senha_hash' => Hash::make($request->senha),
        'empresa_id' => $request->empresa_id,
        'tipo_usuario' => $request->tipo_usuario,
        'data_cadastro' => now(),
    ]);

    return redirect('/login')->with('success', 'Usuário registrado com sucesso!');
}
}
