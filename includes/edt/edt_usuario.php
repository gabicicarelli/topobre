<?php
require_once '../db.php';
require_once '../funcoes.php';
session_start();
$id = $_SESSION['id'];

$db = new db;

$a = [
  'telefone' => empty($_POST['telefone']) ? null : $_POST['telefone'],
  'email' => empty($_POST['email']) ? null : $_POST['email'],
  'cep' => empty($_POST['cep']) ? null : $_POST['cep'],
  'endereco' => empty($_POST['endereco']) ? null : $_POST['endereco'],
  'bairro' => empty($_POST['bairro']) ? null : $_POST['bairro'],
  'cidade' => empty($_POST['cidade']) ? null : $_POST['cidade'],
  'estado' => empty($_POST['estado']) ? null : $_POST['estado']
];

$_SESSION['msg'] = '<div class="alert alert-primary" role="alert"><i class="fas fa-check"></i> Dados alterados!</div>';
$db->where('idUsuario', $id);
$db->update('tbusuario', $a);

header('Location: ../../perfil.php');
exit;
