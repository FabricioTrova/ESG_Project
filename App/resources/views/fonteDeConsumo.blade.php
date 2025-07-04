<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DashCarbon - Consumo</title>
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- inicio do Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DashCarbon</div>
            </a>
            <!-- Traço de divisão -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
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
            <!-- Traço de divisão -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Complementos
            </div>
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
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
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
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- icone do perfil e configuraçãoo / Mostra o nome do usuário que está logado -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->nome }}
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
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
                <!-- Exibe mensagens de sucesso ou erro -->
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <!-- Card com tabela e botão para abrir modal -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Registros de fontes de consumo</h6>
                            <a href="#" class="btn btn-light btn-icon-split" data-toggle="modal"
                                data-target="#registroModal">
                                <span class="icon text-gray-600"><i class="fas fa-arrow-right"></i></span>
                                <span class="text">Registrar</span>
                            </a>
                        </div>
                        <!-- Tabela de registros -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome do consumo</th>
                                            <th>Quantidade consumida</th>
                                            <th>Fator Emissão</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($fontes) && $fontes->count() > 0)
                                            @foreach ($fontes as $fonte)
                                                <tr>
                                                    <td>{{ $fonte->nome }}</td>
                                                    <td>{{ $fonte->unidade_medida }}</td>
                                                    <td>{{ number_format($fonte->fator_emissao, 2) }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-sm edit-btn"
                                                            data-id="{{ $fonte->id }}"
                                                            data-nome="{{ $fonte->nome }}"
                                                            data-unidade="{{ $fonte->unidade_medida }}"
                                                            data-emissao="{{ $fonte->fator_emissao }}">
                                                            Editar
                                                        </a>
                                                        <form action="{{ route('fontes.destroy', $fonte->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Nenhum registro encontrado.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal de Registro -->
                            <div class="modal fade" id="registroModal" tabindex="-1" role="dialog"
                                aria-labelledby="registroModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="registroModalLabel">Registrar Consumo</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="registroForm" action="{{ route('fontes.store') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" id="registro_id" name="id">
                                                <input type="hidden" name="_method" value="POST">
                                                <div class="form-group">
                                                    <label for="nome" class="font-weight-bold">Tipo de
                                                        Consumo</label>
                                                    <input type="text" class="form-control" id="nome"
                                                        name="nome" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="unidade_medida" class="font-weight-bold">Unidade de
                                                        Medida (Ex: Litros, m³, kWh)</label>
                                                    <input type="text" class="form-control" id="unidade_medida"
                                                        name="unidade_medida" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fator_emissao" class="font-weight-bold">Fator de
                                                        Emissão (gCO2e/unidade)</label>
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="fator_emissao" name="fator_emissao" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fechar</button>
                                            <button type="submit" form="registroForm" class="btn btn-primary"
                                                id="salvarBtn">Salvar</button>
                                            <button type="submit" form="registroForm" class="btn btn-warning"
                                                id="editarBtn" style="display: none;">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">Selecione 'Sair' abaixo se estiver pronto para encerrar sua sessão
                                atual.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                    data-dismiss="modal">Cancelar</button>
                                <a class="btn btn-primary" href="{{ url('/login') }}">Sair</a>
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
        <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
        <!-- Script para abrir modal com dados para edição -->
        <script>
            function abrirModalEdicao(id, fonte, quantidade, emissoes, origem) {
                $('#registro_id').val(id);
                $('#fonte_consumo').val(fonte);
                $('#quantidade_consumida').val(quantidade);
                $('#emissoes_co2').val(emissoes);
                $('#origem_dado').val(origem);
                $('#salvarBtn').hide();
                $('#editarBtn').show();
                $('#registroModalLabel').text('Editar Consumo');
                $('#registroForm').attr('action', "{{ url('fontes') }}/" + id);
                $('#registroForm').find('input[name="_method"]').val('PUT');
                $('#registroModal').modal('show');
            }
            // Resetar modal ao fechar
            $('#registroModal').on('hidden.bs.modal', function() {
                $('#registroForm')[0].reset();
                $('#registro_id').val('');
                $('#salvarBtn').show();
                $('#editarBtn').hide();
                $('#registroModalLabel').text('Registrar Consumo');
                $('#registroForm').attr('action', "{{ route('fontes.store') }}");
                $('#registroForm').find('input[name="_method"]').val('POST');
            });
            // Disparar edição ao clicar no botão
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var fonte = $(this).data('fonte');
                var quantidade = $(this).data('quantidade');
                var emissoes = $(this).data('emissoes');

                abrirModalEdicao(id, fonte, quantidade, emissoes);
            });
        </script>
</body>
</html>
