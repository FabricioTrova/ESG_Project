<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastrar Empresa</title>
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
                        

                        <h2 class= "text-center">Cadastro de Empresa</h2>

                        @if(session('success'))
                        <p style="color:green">{{ session('success') }}</p>
                        @endif
                        <br> 
                        <form action="{{ route('empresas.store') }}" method="POST">
                        @csrf
         
                        <div class="form-group ">
                        <input type="text" class = "form-control form-control-user" name="nome" value="{{ old('nome') }}" 
                        placeholder="Nome da empresa" required><br>             
                         @error('nome') <span style="color:red">{{ $message }}</span><br> @enderror
                        </div>
            
                        <div class="form-group">
                        <input type="text" class = "form-control form-control-user" name="cnpj" value="{{ old('cnpj') }}" 
                        placeholder="Cnpj" required><br>
                        @error('cnpj') <span style="color:red">{{ $message }}</span><br> @enderror
                        </div>

                        <div class="form-group">
                        <input type="text" class = "form-control form-control-user" name="setor_atividade" value="{{ old('setor_atividade') }}" 
                        placeholder = "Setor de Atividade" required><br>
                        @error('setor_atividade') <span style="color:red">{{ $message }}</span><br> @enderror
                        </div>

                        <div class="form-group">
                        <input type="text" class = "form-control form-control-user" name="endereco" value="{{ old('endereco') }}" 
                        placeholder="Endereço" required><br>
                        @error('endereco') <span style="color:red">{{ $message }}</span><br> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block" >Cadastrar</button>
            
                    </div>
                </div>    
            </div>
        </div>
         <h3>Empresas Cadastradas</h3>
        <ul>
            @foreach($empresas as $empresa)
                <li>{{ $empresa->nome }} - {{ $empresa->cnpj }}</li>
            @endforeach
        </ul>
        </div>
        </div>
        </div>
        </div>
        </div>  
        <br>
    </form>

</body>
</html>