<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastrar Empresa</title>
    <!-- Fontes e ícones primeiro -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap (de preferência por CDN se for usar DataTables CDN também) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Seu CSS customizado por último -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body>
    <!-- @if (session('success'))
<p style="color:green">{{ session('success') }}</p>
        @endif -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DashCarbon</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Registros</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class=" collapse-item" href="{{ url('/historico') }}">
                                <span>Cadastro Consumo</span></a>
                            <a class="collapse-item" href="{{ url('/fonteDeConsumo') }}">Fontes de Consumo</a>
                        </div>
                    </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Complementos
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Administração</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Acessos:</h6>
                        <a class="collapse-item" href="{{ url('/empresas') }}">Cadastro de Empresas</a>
                        <a class="collapse-item" href="{{ url('/register') }}">Cadastro de Usuário</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/charts') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Graficos</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Botao de fechar barra lateral -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">>
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Pesquise por..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- icone do perfil e configuraçãoo / Mostra o nome do usuário que está logado -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->nome }}
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Tabela de empresas cadastradas -->
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Empresas Cadastradas</h6>
                            <a href="#" class="btn btn-light btn-icon-split" data-toggle="modal"
                                data-target="#empresaModal">
                                <span class="icon text-gray-600"><i class="fas fa-arrow-right"></i></span>
                                <span class="text">Adicionar Empresa</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CNPJ</th>
                                            <th>Setor de Atividade</th>
                                            <th>Endereço</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($empresas->count() > 0){
                                            @foreach ($empresas as $empresa){
                                                <tr>
                                                    <td>{{ $empresa->nome }}</td>
                                                    <td>{{ $empresa->cnpj }}</td>
                                                    <td>{{ $empresa->setor_atividade }}</td>
                                                    <td>{{ $empresa->endereco }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-sm edit-btn"
                                                            data-id="{{ $empresa->id }}"
                                                            data-nome="{{ htmlspecialchars($empresa->nome) }}"
                                                            data-cnpj="{{ htmlspecialchars($empresa->cnpj) }}"
                                                            data-setor="{{ htmlspecialchars($empresa->setor_atividade) }}"
                                                            data-endereco="{{ htmlspecialchars($empresa->endereco) }}">
                                                            Editar
                                                        </a>
                                                        <form action="{{ route('empresas.destroy', $empresa->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Deseja realmente excluir esta empresa?')"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Excluir</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            } 
                                            @endforeach
                                        }  
                                        @else{
                                            <tr>
                                                <td colspan="5" class="text-center">Nenhuma empresa cadastrada.
                                                </td>
                                            </tr>
                                        }
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal de Adicionar/Editar Empresa -->
                            <div class="modal fade" id="empresaModal" tabindex="-1" role="dialog"
                                aria-labelledby="empresaModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="empresaModalLabel">Adicionar Empresa</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="empresaForm" action="{{ route('empresas.store') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" id="empresa_id" name="id">
                                                <input type="hidden" name="_method" value="POST">

                                                <div class="form-group">
                                                    <label for="nome" class="font-weight-bold">Nome</label>
                                                    <input type="text" class="form-control" id="nome"
                                                        name="nome" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cnpj" class="font-weight-bold">CNPJ</label>
                                                    <input type="text" class="form-control" id="cnpj"
                                                        name="cnpj" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="setor_atividade" class="font-weight-bold">Setor de
                                                        Atividade</label>
                                                    <input type="text" class="form-control" id="setor_atividade"
                                                        name="setor_atividade" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="endereco" class="font-weight-bold">Endereço</label>
                                                    <input type="text" class="form-control" id="endereco"
                                                        name="endereco" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fechar</button>
                                            <button type="submit" form="empresaForm" class="btn btn-primary"
                                                id="salvarBtn">Salvar</button>
                                            <button type="submit" form="empresaForm" class="btn btn-warning"
                                                id="editarBtn" style="display: none;">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- scripts -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
                <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
                <script>
                    var urlEmpresas = "{{ url('empresas') }}"; // variavel js
                </script>
                <script>
                    var urlEmpresasStore = "{{ route('empresas.store') }}"; //variavel js
                </script>
</body>
</html>