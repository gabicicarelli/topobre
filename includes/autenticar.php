<?php

session_start();

require_once 'db.php';
require_once 'funcoes.php';

$db = new db;
$db->where('cpf', $_POST['cpf']);
$dados = $db->get('tbusuario', null, '*');

if (validaCPF($_POST['cpf'])) { 
  
  if(empty($dados)){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="tim-icons icon-simple-remove"></i> CPF não cadastrado.</div>';
    header('Location: ../index.php');
  }

  foreach ($dados as $d) {
    if ($d['cpf'] == $_POST['cpf']) {
      if ($d['senha'] == makeHash($_POST['senha'], $_POST['cpf'])) {
        $_SESSION['id'] = $d['idUsuario'];
        $_SESSION['nome'] = $d['nome'] . ' ' . $d['sobrenome'];
        header('Location: ../email.php');
      } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="tim-icons icon-volume-98"></i> Senha inválida.</div>';
        header('Location: ../index.php');
      }
    }else{
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="tim-icons icon-volume-98"></i> CPF não cadastrado.</div>';
      header('Location: ../signup.php');
    }
  }
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="tim-icons icon-simple-remove"></i> CPF inválido.</div>';
  header('Location: ../index.php');
}
