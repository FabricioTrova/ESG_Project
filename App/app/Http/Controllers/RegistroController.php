<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UsuarioController;

class RegistroController extends Controller
{
    public function showUserForm()
    {
        // Apenas admin pode visualizar o form de cadastro de usuário
        $user = auth()->user();
        if ($user && $user->tipo_usuario !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $empresas = Empresa::all();
        $usuarios = Usuario::with('empresa')->get();

        return view('auth.register-user', compact('empresas', 'usuarios'));


    }

    public function registrarUsuario(Request $request)
    {
        // Apenas admin pode registrar novos usuários
        $user = auth()->user();
        if ($user && $user->tipo_usuario !== 'admin') {
            abort(403, 'Acesso não autorizado');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6|confirmed',
            'empresa_id' => 'required|exists:empresas,id',
            'tipo_usuario' => 'required|in:admin,gestor,colaborador',
        ]);

        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha_hash' => Hash::make($request->senha),
            'empresa_id' => $request->empresa_id,
            'tipo_usuario' => $request->tipo_usuario,
            'data_cadastro' => now(),
        ]);

        //redireciona para a página de registro com uma mensagem de sucesso
        return redirect('/register')->with('success', 'Usuário registrado com sucesso!');
    }

 public function destroy($id)
{
    $usuario = Usuario::find($id);

    if (!$usuario) {
        return redirect()->route('usuario.index')->with('error', 'Usuário não encontrado.');
    }

    $usuario->delete();

    return redirect()->route('usuario.index')->with('success', 'Usuário excluído com sucesso.');
}

    public function index()
    {
        $empresas = Empresa::all();
        $usuarios = Usuario::with('empresa')->get();
        return view('auth.register-user', compact('usuarios', 'empresas'));
    }
}
