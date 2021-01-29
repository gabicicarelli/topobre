<?php

session_start();
require_once '../db.php';
require_once '../funcoes.php';

if (validaCPF($_POST['cpf'])) {
  $db = new db;
  $db->where('cpf', $_POST['cpf']);
  $dados = $db->get('tbusuario', null, '*');
  foreach ($dados as $d) {
    if ($d['cpf'] == $_POST['cpf']) {
      $_SESSION['msg'] = '<div class="alert alert-warning" role="alert"><i class="tim-icons icon-volume-98"></i> Usuário já existe.</div>';
      header('Location: ../../signup.php');
      break;
    }
  }

  try{
    $c = Array (
      'cpf' => $_POST['cpf'],
      'nome' => $_POST['nome'],
      'sobrenome' => $_POST['sobrenome'],
      'email' => $_POST['email'],
      'senha' => makeHash($_POST['senha'], $_POST['cpf'])
    );

    $usuario = $db->insert('tbusuario', $c);
    $_SESSION['msg'] = '<div class="alert alert-primary" role="alert"><i class="tim-icons icon-check-2"></i> Sucesso!</div>';
    header('Location: ../../index.php');
  }
  catch (Exception $e){
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";

  }

  
  
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="tim-icons icon-simple-remove"></i> CPF inválido.</div>';
  header('Location: ../../signup.php');
}
