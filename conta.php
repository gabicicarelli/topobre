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
    <title>To Pobre - Minhas Contas</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css" rel="stylesheet" />
    <link href="assets/demo/demo.css" rel="stylesheet" />
  </head>

  <body class="">
    <div class="wrapper">
      <!-- Menu Lateral -->
      <div class="sidebar">
        <div class="sidebar-wrapper">
          <div class="logo">
            <img src="assets/img/now-logo.png" alt="">
          </div>
          <ul class="nav">
            <li>
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
            <li class="active">
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
              <a class="navbar-brand" href="">Minhas Contas</a>
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
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="card-title"> Contas</h4>
                    </div>
                    <div class="col-md-2">
                      <button class="btn btn-round" data-toggle="modal" data-target="#AdicionarConta"><i class="tim-icons icon-simple-add"></i></button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table tablesorter" id="">
                      <thead class=" text-primary">
                        <tr>
                          <th>Tipo</th>
                          <th>Banco</th>
                          <th>Agência</th>
                          <th>Conta</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            Dakota Rice
                          </td>
                          <td>
                            Niger
                          </td>
                          <td>
                            Oud-Turnhout
                          </td>
                          <td>
                            $36,738
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- Adicionar Conta Modal -->
  <div class="modal fade modal-black" id="AdicionarConta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Nova Conta</h5>
        </div>
        <div class="modal-body">
          <form action="includes/edt/edt_usuario.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-12 pr-md-1">
                <div class="form-group">
                  <label>Tipo</label>
                  <select name="saude" class="custom-select" id="saude">
                    <option value="0">Selecione</option>
                    <?php
                    $tipo = $db->get('tbbanco', null, '*');
                    foreach ($tipo as $t) {
                      echo '<option value="' . $t['idBanco'] . '">' . $t['codigo'] . ' - ' . $t['nome']. '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>              
            </div>
            <div class="row">
              <div class="col-md-6 pr-md-1">
                <div class="form-group">
                  <label>Agência</label>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-md-6 pr-md-1">
                <div class="form-group">
                  <label>Conta</label>
                  <input type="text" class="form-control">
                </div>
              </div>              
            </div>
            <div class="row">
              <div class="col-md-6 pr-md-1">
                <div class="form-group">
                  <div class="form-check form-check-radio">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="tipo" value="Corrente">
                      Corrente
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-6 pr-md-1">
                <div class="form-group">
                  <div class="form-check form-check-radio">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="tipo" value="Poupança">
                      Poupança
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="assets/demo/demo.js"></script>

  </body>

  </html>