<?php
    session_start();
    require_once 'includes/db.php';
    require_once 'includes/funcoes.php';
    ini_set('default_charset', 'UTF-8');

    if (!empty($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $nome = $_SESSION['nome'];
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Acesso Negado!</div>';
        header('Location: index.php');
    }
    $db = new db;
    $db->where('idUsuario', $id);
    $dados = $db->get('tbusuario', null, '*');
    foreach ($dados as  $u) {
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="imagem/png" href="assets/img/icon.ico" />
    <title>To Pobre - Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css" rel="stylesheet" />
    <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <!-- Menu Lateral -->
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <img src="assets/img/now-logo.png" alt="">
                </div>
                <ul class="nav">
                    <li class="active ">
                        <a href="./dashboard.php">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./entrante.php">
                            <i class="tim-icons icon-coins"></i>
                            <p>Entrante</p>
                        </a>
                    </li>
                    <li>
                        <a href="./despesa.php">
                            <i class="tim-icons icon-money-coins"></i>
                            <p>Despesas</p>
                        </a>
                    </li>
                    <li>
                        <a href="./conta.php">
                            <i class="tim-icons icon-bank"></i>
                            <p>Minhas Contas</p>
                        </a>
                    </li>
                    <li>
                        <a href="./investimento.php">
                            <i class="tim-icons icon-wallet-43"></i>
                            <p>Investimentos</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="">Dashboard</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <img src="assets/img/<?= $u['foto'] ?>" alt="Profile Photo">
                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        <?= $nome ?>
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a href="perfil.php" class="nav-item dropdown-item">Meu Perfil</a></li>
                                    <li class="nav-link"><a href="#" class="nav-item dropdown-item">Alterar Senha</a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li class="nav-link"><a href="logout.php" class="nav-item dropdown-item">Sair</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-chart">
                            <div class="card-header ">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <h5 class="card-category">Total de Despesas</h5>
                                        <h2 class="card-title">Anual</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="chartBig1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Entrante</h5>
                                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> R$ 763,215</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="chartLinePurple"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Despesas Mensal</h5>
                                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="CountryChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Poupança</h5>
                                <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="chartLineGreen"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>
    <script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <script src="assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>

</body>

</html>