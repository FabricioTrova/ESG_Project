<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Empresa</title>
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<body>
    <h2>Cadastro de Empresa</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('empresas.store') }}" method="POST">
        @csrf

        <label>Nome:</label><br>
        <input type="text" name="nome" value="{{ old('nome') }}" required><br>
        @error('nome') <span style="color:red">{{ $message }}</span><br> @enderror

        <label>CNPJ:</label><br>
        <input type="text" name="cnpj" value="{{ old('cnpj') }}" required><br>
        @error('cnpj') <span style="color:red">{{ $message }}</span><br> @enderror

        <label>Setor de Atividade:</label><br>
        <input type="text" name="setor_atividade" value="{{ old('setor_atividade') }}" required><br>
        @error('setor_atividade') <span style="color:red">{{ $message }}</span><br> @enderror

        <label>Endereço:</label><br>
        <input type="text" name="endereco" value="{{ old('endereco') }}" required><br>
        @error('endereco') <span style="color:red">{{ $message }}</span><br> @enderror

        <br>
        <button type="submit">Cadastrar</button>
    </form>

    <h3>Empresas Cadastradas</h3>
    <ul>
        @foreach($empresas as $empresa)
            <li>{{ $empresa->nome }} - {{ $empresa->cnpj }}</li>
        @endforeach
    </ul>
</body>
</html>