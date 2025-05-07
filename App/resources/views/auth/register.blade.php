<!DOCTYPE html>
<html lang="Pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DashCarbon - Register</title>

    "<!-- Fontes personalizadas para este modelo -->"
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

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
        <input type="text" name="nome" class="form-control form-control-user" placeholder="Seu nome completo" required>
    </div>

    <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user" placeholder="Email" required>
    </div>

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" name="senha" class="form-control form-control-user" placeholder="Senha" required>
        </div>
        <div class="col-sm-6">
            <input type="password" name="senha_confirmation" class="form-control form-control-user" placeholder="Confirme a senha" required>
        </div>
    </div>

    <div class="form-group">
        <input type="text" name="empresa_nome" class="form-control form-control-user" placeholder="Nome da empresa" required>
    </div>

    <div class="form-group">
        <input type="text" name="empresa_cnpj" class="form-control form-control-user" placeholder="CNPJ da empresa" required>
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

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>