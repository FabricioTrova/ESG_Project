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
        <i class="fas fa-leaf"></i>
    </div>
    <div class="sidebar-brand-text mx-3">DashCarbon</div>
</a>

<!-- Divider -->
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

                <!-- Espaço entre os blocos -->
                <div class="row g-3 mb-4">
                    <!-- Card Calcular Pegada de Carbono -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-left-success h-100">
                            <div class="card-body">
                                <form action="{{ route('analise_carbono.calcular') }}" method="POST">
                                    @csrf
                                    <!-- Título com tooltip -->
                                    <div class="mb-3">
                                        <label class="form-label text-success fw-semibold mb-0"
                                            data-bs-toggle="tooltip"
                                            title="Clique aqui para realizar o cálculo da Pegada de Carbono da sua empresa.">
                                            <i class="fas fa-leaf me-1"></i> Realizar Cálculo de Pegada de Carbono
                                        </label>
                                    </div>
                                    <!-- Campos e botão -->
                                    <div class="row align-items-end g-3">
                                        <div class="col-md-6">
                                            <label for="data_inicio" class="form-label text-success fw-semibold">
                                                <i class="fas fa-calendar-alt me-1"></i> Início
                                            </label>
                                            <input type="date" name="data_inicio" id="data_inicio"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="data_fim" class="form-label text-success fw-semibold">
                                                <i class="fas fa-calendar-alt me-1"></i> Fim
                                            </label>
                                            <input type="date" name="data_fim" id="data_fim"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success btn-sm w-100">
                                                <i class="fas fa-calculator me-1"></i> Calcular
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @if (session('success')){
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                }
                                @endif
                                @if (session('error')){
                                    <div class="alert alert-danger mt-3">
                                        {{ session('error') }}
                                    </div>
                                }
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Card Filtros -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-left-primary h-100">
                            <div class="card-body">
                                <form id="filter-form">
                                    <!-- Título -->
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-semibold" data-bs-toggle="tooltip"
                                            title="Filtros relacionados ao impacto ambiental das atividades.">
                                            <i class="fas fa-leaf me-1"></i> Filtros
                                        </label>
                                    </div>
                                    <!-- Campos e botões -->
                                    <div class="row align-items-end g-3">
                                        <div class="col-md-6">
                                            <label for="data_inicio_filter"
                                                class="form-label text-primary fw-semibold">
                                                <i class="fas fa-calendar-alt me-1"></i> Início
                                            </label>
                                            <input type="date" name="data_inicio" id="data_inicio_filter"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="data_fim_filter" class="form-label text-primary fw-semibold">
                                                <i class="fas fa-calendar-alt me-1"></i> Fim
                                            </label>
                                            <input type="date" name="data_fim" id="data_fim_filter"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 d-flex gap-2">
                                            <button type="button" onclick="applyFilters()"
                                                class="btn btn-primary btn-sm w-50">
                                                <i class="fas fa-filter me-1"></i> Filtrar
                                            </button>
                                            <button type="button" onclick="resetFilters()"
                                                class="btn btn-outline-secondary btn-sm w-50">
                                                <i class="fas fa-undo me-1"></i> Limpar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm border-left-success mt-3">
                    <div class="card-body">
                        <h6 class="text-success fw-bold mb-3">
                            <i class="fas fa-chart-line me-1"></i> Evolução da Pegada de Carbono
                        </h6>
                        <div id="loading" class="text-center my-3" style="display: none;">
                            <div class="spinner-border text-success" role="status"></div>
                            <p class="mt-2 text-muted">Carregando dados...</p>
                        </div>
                        <canvas id="graficoCarbono" height="100"></canvas>
                    </div>
                </div>
                <script>
                    let graficoCarbono;
                    function applyFilters(){
                        const dataInicio = document.getElementById("data_inicio_filter").value;
                        const dataFim = document.getElementById("data_fim_filter").value;
                        // Mostra o loading
                        document.getElementById("loading").style.display = "block";
                        fetch(`/analises/dados?data_inicio=${dataInicio}&data_fim=${dataFim}`)
                            .then(response => response.json())
                            .then(data => {
                                renderizarGrafico(data.labels, data.valores);
                                document.getElementById("loading").style.display = "none";
                            })
                            .catch(error => {
                                console.error("Erro ao buscar dados:", error);
                                document.getElementById("loading").style.display = "none";
                                alert("Erro ao buscar dados. Tente novamente.");
                            });
                    }

                    function renderizarGrafico(labels, valores){
                        const ctx = document.getElementById('graficoCarbono').getContext('2d');
                        if (graficoCarbono) {
                            graficoCarbono.destroy(); // Evita sobreposição
                }
            }

    function resetFilters() {
        document.getElementById("data_inicio_filter").value = "";
        document.getElementById("data_fim_filter").value = "";
        applyFilters(); // Pode exibir dados gerais novamente
    }

    // Inicializa com dados padrão
    document.addEventListener("DOMContentLoaded", applyFilters);
</script>

 
<div class="card shadow-sm border-left-info mt-4">
    <div class="card-body">
        <h6 class="text-info fw-bold mb-3">
            <i class="fas fa-chart-pie me-1"></i> Emissão por Fonte
        </h6>
        <div id="loading-fonte" class="text-center my-3" style="display: none;">
            <div class="spinner-border text-info" role="status"></div>
            <p class="mt-2 text-muted">Carregando dados por fonte...</p>
        </div>
        <canvas id="graficoFonte" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let graficoFonte;

   const cores = [
    '#a8e6cf', // Verde água pastel
    '#dcedc1', // Verde claro
    '#aed9e0', // Azul esverdeado claro
    '#81c784', // Verde médio
    '#c5e1a5', // Verde lima claro
    '#b2dfdb', // Verde acinzentado claro
    '#9ccc65', // Verde vibrante mas suave
    '#66bb6a', // Verde folha
    '#43a047', // Verde escuro suave
    '#2e7d32'  // Verde escuro
];

    function renderizarGraficoFonte(agregadoFontes) {
        const ctx = document.getElementById('graficoFonte').getContext('2d');

        const labels = Object.keys(agregadoFontes);
        const valores = Object.values(agregadoFontes).map(v => (v / 1000).toFixed(2)); // Convert gCO2e to kgCO2e

        if (graficoFonte) {
            graficoFonte.destroy();
        }

        graficoFonte = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Emissão por Fonte (kgCO₂e)',
                    data: valores,
                    backgroundColor: cores.slice(0, valores.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: context => `${context.label}: ${context.formattedValue} kgCO₂e`
                        }
                        graficoCarbono = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Emissão (kgCO₂e)',
                                    data: valores,
                                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                                    borderColor: 'rgba(40, 167, 69, 1)',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.3,
                                    pointRadius: 4
                                }]
                            },
                            options:{
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Emissão (kgCO₂e)'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Data'
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        mode: 'index',
                                        intersect: false
                                    },
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    }
                    function resetFilters() {
                        document.getElementById("data_inicio_filter").value = "";
                        document.getElementById("data_fim_filter").value = "";
                        applyFilters(); // Pode exibir dados gerais novamente
                    }
                    // Inicializa com dados padrão
                    document.addEventListener("DOMContentLoaded", applyFilters);
                </script>
                <div class="card shadow-sm border-left-info mt-4">
                    <div class="card-body">
                        <h6 class="text-info fw-bold mb-3">
                            <i class="fas fa-chart-pie me-1"></i> Emissão por Fonte
                        </h6>
                        <div id="loading-fonte" class="text-center my-3" style="display: none;">
                            <div class="spinner-border text-info" role="status"></div>
                            <p class="mt-2 text-muted">Carregando dados por fonte...</p>
                        </div>
                        <canvas id="graficoFonte" height="100"></canvas>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    let graficoFonte;
                    const cores = [
                        '#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8',
                        '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
                    ];

<!-- Espaço entre os blocos -->
<div class="row g-3 mb-4">
    <!-- Card Calcular Pegada de Carbono -->
    <div class="col-md-6">
        <div class="card shadow-sm border-left-success h-100">
            <div class="card-body">
                <form action="{{ route('analise_carbono.calcular') }}" method="POST">
                    @csrf
                    <!-- Título com tooltip -->
                    <div class="mb-3">
                        <label class="form-label text-success fw-semibold mb-0" 
                               data-bs-toggle="tooltip" 
                               title="Clique aqui para realizar o cálculo da Pegada de Carbono da sua empresa.">
                            <i class="fas fa-leaf me-1"></i> Realizar Cálculo de Pegada de Carbono
                        </label>
                    </div>

                    <!-- Campos e botão -->
                    <div class="row align-items-end g-3">
                        <div class="col-md-6">
                            <label for="data_inicio" class="form-label text-success fw-semibold">
                                <i class="fas fa-calendar-alt me-1"></i> Início
                            </label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label for="data_fim" class="form-label text-success fw-semibold">
                                <i class="fas fa-calendar-alt me-1"></i> Fim
                            </label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                <i class="fas fa-calculator me-1"></i> Calcular
                            </button>
                        </div>
                }
            }
        });
    }

    function carregarDadosFonte() {
        document.getElementById('loading-fonte').style.display = 'block';

        fetch('/analises/fontes')
            .then(response => response.json())
            .then(agregado => {
                renderizarGraficoFonte(agregado);
                document.getElementById('loading-fonte').style.display = 'none';
            })
            .catch(error => {
                console.error('Erro ao carregar dados por fonte:', error);
                document.getElementById('loading-fonte').style.display = 'none';
            });
    }

    document.addEventListener('DOMContentLoaded', carregarDadosFonte);
</script>

                    </div>
                </form>

                @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Card Filtros -->
    <div class="col-md-6">
        <div class="card shadow-sm border-left-primary h-100">
            <div class="card-body">
                <form id="filter-form">
                    <!-- Título -->
                    <div class="mb-3">
                        <label class="form-label text-primary fw-semibold" 
                               data-bs-toggle="tooltip" 
                               title="Filtros relacionados ao impacto ambiental das atividades.">
                            <i class="fas fa-leaf me-1"></i> Filtros
                        </label>
                    </div>

                    <!-- Campos e botões -->
                    <div class="row align-items-end g-3">
                        <div class="col-md-6">
                            <label for="data_inicio_filter" class="form-label text-primary fw-semibold">
                                <i class="fas fa-calendar-alt me-1"></i> Início
                            </label>
                            <input type="date" name="data_inicio" id="data_inicio_filter" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label for="data_fim_filter" class="form-label text-primary fw-semibold">
                                <i class="fas fa-calendar-alt me-1"></i> Fim
                            </label>
                            <input type="date" name="data_fim" id="data_fim_filter" class="form-control form-control-sm">
                        </div>
                        <div class="col-12 d-flex gap-2">
                            <button type="button" onclick="applyFilters()" class="btn btn-primary btn-sm w-50">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                            <button type="button" onclick="resetFilters()" class="btn btn-outline-secondary btn-sm w-50">
                                <i class="fas fa-undo me-1"></i> Limpar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="card shadow-sm border-left-success mt-3">
    <div class="card-body">
        <h6 class="text-success fw-bold mb-3">
            <i class="fas fa-chart-line me-1"></i> Evolução da Pegada de Carbono
        </h6>
        <div id="loading" class="text-center my-3" style="display: none;">
            <div class="spinner-border text-success" role="status"></div>
            <p class="mt-2 text-muted">Carregando dados...</p>
        </div>
        <canvas id="graficoCarbono" height="100"></canvas>
    </div>
</div>

<script>
    let graficoCarbono;

    function applyFilters() {
        const dataInicio = document.getElementById("data_inicio_filter").value;
        const dataFim = document.getElementById("data_fim_filter").value;

        // Mostra o loading
        document.getElementById("loading").style.display = "block";

        fetch(`/analises/dados?data_inicio=${dataInicio}&data_fim=${dataFim}`)
            .then(response => response.json())
            .then(data => {
                renderizarGrafico(data.labels, data.valores);
                document.getElementById("loading").style.display = "none";
            })
            .catch(error => {
                console.error("Erro ao buscar dados:", error);
                document.getElementById("loading").style.display = "none";
                alert("Erro ao buscar dados. Tente novamente.");
            });
    }

    function renderizarGrafico(labels, valores) {
        const ctx = document.getElementById('graficoCarbono').getContext('2d');

        if (graficoCarbono) {
            graficoCarbono.destroy(); // Evita sobreposição
        }

        graficoCarbono = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Emissão (kgCO₂e)',
                    data: valores,
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Emissão (kgCO₂e)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Data'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    }

    function resetFilters() {
        document.getElementById("data_inicio_filter").value = "";
        document.getElementById("data_fim_filter").value = "";
        applyFilters(); // Pode exibir dados gerais novamente
    }

    // Inicializa com dados padrão
    document.addEventListener("DOMContentLoaded", applyFilters);
</script>

 
<div class="card shadow-sm border-left-info mt-4">
    <div class="card-body">
        <h6 class="text-info fw-bold mb-3">
            <i class="fas fa-chart-pie me-1"></i> Emissão por Fonte
        </h6>
        <div id="loading-fonte" class="text-center my-3" style="display: none;">
            <div class="spinner-border text-info" role="status"></div>
            <p class="mt-2 text-muted">Carregando dados por fonte...</p>
        </div>
        <canvas id="graficoFonte" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let graficoFonte;

    const cores = [
        '#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8',
        '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
    ];

    function renderizarGraficoFonte(agregadoFontes) {
        const ctx = document.getElementById('graficoFonte').getContext('2d');

        const labels = Object.keys(agregadoFontes);
        const valores = Object.values(agregadoFontes).map(v => (v / 1000).toFixed(2)); // Convert gCO2e to kgCO2e

        if (graficoFonte) {
            graficoFonte.destroy();
        }

        graficoFonte = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Emissão por Fonte (kgCO₂e)',
                    data: valores,
                    backgroundColor: cores.slice(0, valores.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: context => `${context.label}: ${context.formattedValue} kgCO₂e`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'kgCO₂e' }
                    },
                    x: {
                        title: { display: true, text: 'Fonte' }
                    }
                }
            }
        });
    }

    function carregarDadosFonte() {
        document.getElementById('loading-fonte').style.display = 'block';

        fetch('/analises/fontes')
            .then(response => response.json())
            .then(agregado => {
                renderizarGraficoFonte(agregado);
                document.getElementById('loading-fonte').style.display = 'none';
            })
            .catch(error => {
                console.error('Erro ao carregar dados por fonte:', error);
                document.getElementById('loading-fonte').style.display = 'none';
            });
    }

    document.addEventListener('DOMContentLoaded', carregarDadosFonte);
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
    let myPieChart;

    const coresPizza = [
        '#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8',
        '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
    ];

    function renderizarPizzaFontes(agregadoFontes) {
        const ctx = document.getElementById('myPieChart').getContext('2d');

        const labels = Object.keys(agregadoFontes);
        const valores = Object.values(agregadoFontes).map(v => (v / 1000).toFixed(2)); // gCO2e → kgCO2e

        if (myPieChart) {
            myPieChart.destroy();
        }

        myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: valores,
                    backgroundColor: coresPizza.slice(0, valores.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.formattedValue || '';
                                return `${label}: ${value} kgCO₂e`;
                            }
                        }
                    }
                }
            }
        });
    }

    function carregarDadosPizza() {
        fetch('/analises/fontes')
            .then(response => response.json())
            .then(agregado => {
                renderizarPizzaFontes(agregado);
            })
            .catch(error => {
                console.error('Erro ao carregar dados da pizza:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', carregarDadosPizza);
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
