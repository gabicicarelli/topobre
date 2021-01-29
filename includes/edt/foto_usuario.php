<?php
require_once '../db.php';
require_once '../funcoes.php';
session_start();
$id = $_SESSION['id'];
$db = new db;

$arquivo_tmp = $_FILES['foto']['tmp_name'];
$nome = $_FILES['foto']['name'];
// Pega a extensão
$extensao = pathinfo($nome, PATHINFO_EXTENSION);
// Converte a extensão para minúsculo
$extensao = strtolower($extensao);
if (strstr('.jpg;.jpeg;.png', $extensao)) {
  $novoNome = $id . '.' . $extensao;
  // Concatena a pasta com o nome
  $destino = '../../assets/img/' . $novoNome;
  // tenta mover o arquivo para o destino
  if (@move_uploaded_file($arquivo_tmp, $destino)) {
    echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
  } else
    echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
} else
  echo 'Extensão inválida. Somente aceita jpg, jpeg, png';

$a = [
  'foto' => $novoNome,
];

$_SESSION['msg'] = '<div class="alert alert-primary" role="alert"><i class="fas fa-check"></i> Dados alterados!</div>';
$db->where('idUsuario', $id);
$db->update('tbusuario', $a);

header('Location: ../../perfil.php');
