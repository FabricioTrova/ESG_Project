<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DashCarbon - Histórico</title>
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-text mx-3">DashCarbon</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Registros</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class=" collapse-item" href="{{ url('/historico') }}">
                        <span>Historico de consumo</span></a>
          
                        <a class="collapse-item" href="{{url('/fonteDeConsumo')}}">Fontes de consumo</a>
                    </div>
                </div>
            </li> 
            <hr class="sidebar-divider">

            <div class="sidebar-heading">Complementos</div>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/charts') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráfico</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquise por..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Alerts Center</h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">Message Center</h6>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                        <!-- icone do perfil e configuraçãoo -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuração
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>


                <!-- aqui é o modal onde voce faz os registro das informaçoes para a tabela -->
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Registros de Informações ESG</h6>

                            <!-- botão para  abrir modal e registrar os registro -->
                            <a href="#" class="btn btn-light btn-icon-split" data-toggle="modal" data-target="#registroModal">
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
                    <th>Fonte de Consumo</th>
                    <th>Quantidade</th>
                    <th>Emissões CO₂</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($consumos) && $consumos->count() > 0)
                    @foreach($consumos as $consumo)
<tr>
    <td>{{ $consumo->fonte_consumo }}</td>
    <td>{{ $consumo->quantidade_consumida }}</td>
    <td>{{ number_format($consumo->emissoes_co2, 2) }}</td>
    <td>
        <a href="#" class="btn btn-warning btn-sm edit-btn"
           data-id="{{ $consumo->id }}"
           data-fonte="{{ $consumo->fonte_consumo }}"
           data-quantidade="{{ $consumo->quantidade_consumida }}"
           data-emissoes="{{ $consumo->emissoes_co2 }}">
            Editar
        </a>
        <form action="{{ route('consumos.destroy', $consumo->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</button>
        </form>
    </td>
</tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Nenhum consumo registrado.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal de Registro / Edição -->
    <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Registrar Consumo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="registroForm" action="{{ route('consumos.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="registro_id" name="id">
                        <input type="hidden" name="_method" value="POST">

                        <div class="form-group">
                            <label for="nome" class="font-weight-bold">Tipo de Consumo</label>
                                <select name="fonte_consumo_id" id="fonte_consumo" class="form-control" required>
                                  <option value="">Selecione a fonte</option>
                                     @foreach($fontes as $fonte)
                                      <option value="{{ $fonte->id }}">{{ $fonte->nome }}</option>
                                     @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="quantidade_consumida" class="font-weight-bold">Quantidade Consumida</label>
                            <input type="number" step="0.01" class="form-control" id="quantidade_consumida" name="quantidade_consumida" required>
                        </div>
                        <div class="form-group">
                            <label for="emissoes_co2" class="font-weight-bold">Emissões CO₂ (em gCO2e)</label>
                            <input type="number" step="0.01" class="form-control" id="emissoes_co2" name="emissoes_co2" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="registroForm" class="btn btn-primary" id="salvarBtn">Salvar</button>
                    <button type="submit" form="registroForm" class="btn btn-warning" id="editarBtn" style="display: none;">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">Selecione 'Sair' abaixo se estiver pronto para encerrar sua sessão atual.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
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

    <script>
    function abrirModalEdicao(id, fonte, quantidade, emissoes) {
        $('#registro_id').val(id);
        $('#fonte_consumo').val(fonte);
        $('#quantidade_consumida').val(quantidade);
        $('#emissoes_co2').val(emissoes);

        $('#salvarBtn').hide();
        $('#editarBtn').show();
        $('#registroModalLabel').text('Editar Consumo');
        $('#registroForm').attr('action', "{{ url('consumos') }}/" + id);
        $('#registroForm').find('input[name="_method"]').val('PUT');

        $('#registroModal').modal('show');
    }

    $('#registroModal').on('hidden.bs.modal', function () {
        $('#registroForm')[0].reset();
        $('#registro_id').val('');
        $('#salvarBtn').show();
        $('#editarBtn').hide();
        $('#registroModalLabel').text('Registrar Consumo');
        $('#registroForm').attr('action', "{{ route('consumos.store') }}");
        $('#registroForm').find('input[name="_method"]').val('POST');
    });

    $('.edit-btn').on('click', function () {
        var id = $(this).data('id');
        var fonte = $(this).data('fonte');
        var quantidade = $(this).data('quantidade');
        var emissoes = $(this).data('emissoes');

        abrirModalEdicao(id, fonte, quantidade, emissoes);
    });

</script>

</body>
</html>