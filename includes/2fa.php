<?php

require '../vendor/autoload.php';
require 'token_google.php';
require_once 'db.php';
require_once 'funcoes.php';
session_start();



$code = $_POST['token'];
$id = $_SESSION['id'];
if ($g->checkCode($secret, $code)) {
  header('Location: ../dashboard.php');
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="tim-icons icon-simple-remove"></i> Ocorreu um erro ao validar o código. Solicite o envio e tente novamente</div>';
  header('Location: ../token.php');
}
