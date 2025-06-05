<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    public function showLoginForm(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required'],
        ]);
        $user = Usuario::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['senha'], $user->senha_hash)) {
            Auth::login($user);
            $request->session()->regenerate();
            // Redirecionamento baseado em tipo de usuário
            switch ($user->tipo_usuario) {
                case 'admin':
                    return redirect()->intended('/dashboard');
                case 'gestor':
                    return redirect()->intended('/dashboard');  // Ou outro caminho, ex: /gestor
                case 'colaborador':
                    return redirect()->intended('/dashboard');  // Ou ex: /colaborador
                default:
                    return redirect()->intended('/dashboard');
            }
        }
        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->withInput();
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
