<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DashCarbon - Registro</title>

    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Criar uma Conta!</h1>
                        </div>

                        <form method="POST" action="{{ url('/register') }}" class="user">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif

                            <div class="form-group">
                                <input type="text" name="nome" class="form-control form-control-user"
                                       placeholder="Seu nome completo" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                       placeholder="Email" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="senha" class="form-control form-control-user"
                                           placeholder="Senha" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="senha_confirmation"
                                           class="form-control form-control-user" placeholder="Confirme a senha"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <select name="empresa_id" class="form-control form-control-user" placeholder="Selecione a empresa" required>
                                    <option value="">Selecione uma empresa</option>
                                     @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nome }} ({{ $empresa->cnpj }})</option>
                                     @endforeach
                                </select>

                            </div>

                            <div class="form-group">
    <select name="tipo_usuario" class="form-control form-control-user" placeholder="Selecione o tipo de usuário" required>
        <option value="">Selecione o tipo de usuário</option>
        <option value="admin">Administrador</option>
        <option value="gestor">Gestor</option>
        <option value="colaborador">Colaborador</option>
    </select>
</div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registrar Conta
                            </button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ url('/forgot') }}">Esqueceu a Senha?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ url('/login') }}">Já tem uma conta? Faça login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
