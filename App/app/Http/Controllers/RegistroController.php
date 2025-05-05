<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = DB::table('registro_esg')->get();
        return view('registro_esg.index', compact('registro_esg'));
    }

    public function store(Request $request)
    {
        DB::table('registro_esg')->insert([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'nacionalidade' => $request->nacionalidade,
            'personalidade' => $request->personalidade,
        ]);

        return response()->json(['success' => true]);
    }
}