<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DashCarbon - Gráfico</title>

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- Logo ou ícone -->
                </div>
                <div class="sidebar-brand-text mx-3">DashCarbon</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel</span>
                </a>
            </li>

            <!-- Registros -->
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
          
                        <a class="collapse-item" href="{{url('/fonteDeConsumo')}}">Fontes de Consumo</a>

                    </div>
                </div>
            </li> 

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Complementos</div>

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
                    <span>Gráficos</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
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
                        </li>

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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
<!-- Indicadores Ambientais (KPIs) -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 fw-bold text-primary">Indicadores Ambientais</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card border-left-success">
                                        <div class="card-body py-2">
                                            <div class="text-success fw-bold">
                                                @if(session('success'))
                                            <div class="alert alert-success mt-3">
                                              {{ session('success') }}
                                            </div>
                                              @endif</div>
                                            <div class="small">Valor total de KgCO₂</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card border-left-info">
                                        <div class="card-body py-2">
                                            <div class="text-info fw-bold">89%</div>
                                            <div class="small">Satisfação Sustentável</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card border-left-warning">
                                        <div class="card-body py-2">
                                            <div class="text-warning fw-bold">98%</div>
                                            <div class="small">Compliance Ambiental</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card border-left-primary">
                                        <div class="card-body py-2">
                                            <div class="text-primary fw-bold">5.2</div>
                                            <div class="small">Score ESG</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


    <div class="mb-4">
    <div class="card shadow-sm border-left-success">
        <div class="card-body">
            <form action="{{ route('analise_carbono.calcular') }}" method="POST">
                @csrf
                <label class="form-label text-success fw-semibold mb-0">
                    <i class="fas fa-leaf me-1"></i> Realizar Cálculo de Pegada de Carbono
                </label>
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="data_inicio" class="form-label text-success fw-semibold">
                            <i class="fas fa-calendar-alt me-1"></i> Início
                        </label>
                        <input type="date" name="data_inicio" id="data_inicio" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-3">
                        <label for="data_fim" class="form-label text-success fw-semibold">
                            <i class="fas fa-calendar-alt me-1"></i> Fim
                        </label>
                        <input type="date" name="data_fim" id="data_fim" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-calculator me-1"></i> Calcular
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
</div>
 <!-- Filtros Ambientais -->
                    <div class="mb-4">
                        <div class="card shadow-sm border-left-primary">
                            <div class="card-body">
                                <form id="filter-form" class="row align-items-end">
                                    <div class="col-md-3">
                                        <label for="data_inicio_filter" class="form-label text-primary fw-semibold">
                                            <i class="fas fa-calendar-alt me-1"></i> Início
                                        </label>
                                        <input type="date" name="data_inicio" id="data_inicio_filter" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="data_fim_filter" class="form-label text-primary fw-semibold">
                                            <i class="fas fa-calendar-alt me-1"></i> Fim
                                        </label>
                                        <input type="date" name="data_fim" id="data_fim_filter" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-primary fw-semibold">
                                            <i class="fas fa-leaf me-1"></i> Categoria Ambiental
                                        </label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setCategory('carbon')" data-filter="carbon">
                                                <i class="fas fa-smog me-1"></i> Pegada de Carbono
                                            </button>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setCategory('energy')" data-filter="energy">
                                                <i class="fas fa-bolt me-1"></i> Consumo Energético
                                            </button>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setCategory('fuel')" data-filter="fuel">
                                                <i class="fas fa-gas-pump me-1"></i> Combustível
                                            </button>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setCategory('waste')" data-filter="waste">
                                                <i class="fas fa-recycle me-1"></i> Resíduos
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <button type="button" onclick="applyFilters()" class="btn btn-primary btn-sm">
                                            <i class="fas fa-filter me-1"></i> Filtrar
                                        </button>
                                        <button type="button" onclick="resetFilters()" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-undo me-1"></i> Limpar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

<!-- Gráfico -->
<div class="col-xl-8 col-lg-7 mb-4">
    <div class="card shadow h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Visão Geral das Emissões de Carbono</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Ações:</div>
                    <a class="dropdown-item" href="#">Exportar</a>
                    <a class="dropdown-item" href="#">Configurações</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div style="position: relative; height: 300px;">
                <canvas id="myAreaChart" style="max-height: 400px; width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Importa Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let myChart = null;

function applyFilters() {
    const dataInicio = document.getElementById('data_inicio_filter').value;
    const dataFim = document.getElementById('data_fim_filter').value;
    const url = `/analise-carbono/dados${dataInicio && dataFim ? `?data_inicio=${dataInicio}&data_fim=${dataFim}` : ''}`;

    console.log('Fetching URL:', url); // Depuração

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição: ' + response.status);
            return response.json();
        })
        .then(data => {
            console.log('Dados recebidos:', data); // Depuração

            const ctx = document.getElementById('myAreaChart').getContext('2d');
            if (!myChart) {
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Emissão (kgCO2e)',
                            data: data.valores,
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            pointRadius: 3,
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: 'rgba(78, 115, 223, 1)',
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                            pointHitRadius: 10,
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
                        scales: {
                            x: { grid: { display: false }, title: { display: true, text: 'Período' } },
                            y: { beginAtZero: true, title: { display: true, text: 'Emissão (kgCO2e)' } }
                        },
                        plugins: { legend: { display: true } }
                    }
                });
            } else {
                myChart.data.labels = data.labels;
                myChart.data.datasets[0].data = data.valores;
                myChart.update();
            }
        })
        .catch(error => console.error('Erro ao carregar gráfico:', error));
}

function resetFilters() {
    document.getElementById('data_inicio_filter').value = '';
    document.getElementById('data_fim_filter').value = '';
    applyFilters();
}

// Carregar o gráfico ao abrir a página
document.addEventListener('DOMContentLoaded', applyFilters);
</script>

<div class="col-xl-8 col-lg-7 mb-4">
    <div class="card shadow h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Visão Geral das Emissões - Barras</h6>
        </div>
        <div class="card-body">
            <div style="position: relative; height: 300px;">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/analises/dados')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('myBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Emissão (kgCO2e)',
                        data: data.valores,
                        backgroundColor: 'rgba(28, 200, 138, 0.7)',
                        borderColor: 'rgba(28, 200, 138, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: { title: { display: true, text: 'Período' }},
                        y: { beginAtZero: true, title: { display: true, text: 'Emissão (kgCO2e)' }}
                    },
                    plugins: { legend: { display: true } }
                }
            });
        })
        .catch(error => console.error('Erro ao carregar dados do gráfico:', error));
});
</script>

<div class="col-xl-4 col-lg-5 mb-4">
    <div class="card shadow h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Distribuição das Emissões - Pizza</h6>
        </div>
        <div class="card-body">
            <div style="position: relative; height: 300px;">
                <canvas id="myPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/analises/dados-categoria')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('myPieChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.valores,
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.7)',
                            'rgba(28, 200, 138, 0.7)',
                            'rgba(54, 185, 204, 0.7)',
                            'rgba(246, 194, 62, 0.7)',
                            'rgba(231, 74, 59, 0.7)',
                            'rgba(133, 135, 150, 0.7)'
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: ctx => {
                                    const label = ctx.label || '';
                                    const value = ctx.parsed || 0;
                                    return `${label}: ${value.toFixed(2)} kgCO2e`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Erro ao carregar dados do gráfico:', error));
});
</script>


<div class="col-xl-6 col-lg-6 mb-4">
    <div class="card shadow h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Análise Radar das Emissões</h6>
        </div>
        <div class="card-body">
            <div style="position: relative; height: 300px;">
                <canvas id="myRadarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/analises/dados')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('myRadarChart').getContext('2d');
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Emissão (kgCO2e)',
                        data: data.valores,
                        backgroundColor: 'rgba(78, 115, 223, 0.2)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(78, 115, 223, 1)'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            angleLines: { display: true },
                            suggestedMin: 0
                        }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        })
        .catch(error => console.error('Erro ao carregar dados do gráfico:', error));
});
</script>

                    </div>

                </div>
                <!-- End of container-fluid -->

            </div>
            <!-- End of Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script> 
</body>

</html>
