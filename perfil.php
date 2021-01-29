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
  <title>To Pobre - Meu Perfil</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/black-dashboard.css" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <div class="sidebar-wrapper">
        <div class="logo">
          <img src="assets/img/now-logo.png" alt="">
        </div>
        <ul class="nav">
          <li>
            <a href="./dashboard.html">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./icons.html">
              <i class="tim-icons icon-atom"></i>
              <p>Icons</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="tim-icons icon-pin"></i>
              <p>Maps</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="tim-icons icon-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="active ">
            <a href="./user.html">
              <i class="tim-icons icon-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li>
            <a href="./tables.html">
              <i class="tim-icons icon-puzzle-10"></i>
              <p>Table List</p>
            </a>
          </li>
          <li>
            <a href="./typography.html">
              <i class="tim-icons icon-align-center"></i>
              <p>Typography</p>
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
            <a class="navbar-brand" href="">Meu Perfil</a>
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
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Editar Perfil</h5>
              </div>
              <?php
              if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
              }
              ?>
              <div class="card-body">
                <form action="includes/edt/edt_usuario.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="<?= $u['telefone'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" name="email" class="form-control" value="<?= $u['email'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>CEP</label>
                        <input type="text" name="cep" class="form-control" onblur="pesquisacep(this.value);" value="<?= $u['cep'] ?>">
                      </div>
                    </div>
                    <div class="col-md-8 pl-md-1">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="endereco" class="form-control" id="rua" value="<?= $u['endereco'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control" id="bairro" value="<?= $u['bairro'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-md-1">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" id="cidade" value="<?= $u['cidade'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label>Estado</label>
                        <input type="text" name="estado" class="form-control" id="uf" value="<?= $u['estado'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-fill btn-primary">Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text">
                <div class="author">
                  <div class="block block-one"></div>
                  <div class="block block-two"></div>
                  <div class="block block-three"></div>
                  <div class="block block-four"></div>
                  <a href="#">
                    <img class="avatar" src="assets/img/<?= $u['foto'] ?>" alt="...">
                    <h5 class="title"><?= $nome ?></h5>
                  </a>
                  <form action="includes/edt/foto_usuario.php" enctype="multipart/form-data" method="POST">
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" accept="image/png, image/jpeg">
                        <label class="custom-file-label">Escolher foto</label>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row" style="padding: 3px;">
                        <div class="col-12">
                          <div class="button-container">
                            <button class="btn btn-round" type="submit">
                              Alterar foto
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/demo/demo.js"></script>
  <script src="assets/js/cep.js"></script>

</body>

</html>