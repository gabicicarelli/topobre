<?php
require 'vendor/autoload.php';
require 'includes/token_google.php';
require_once 'includes/db.php';
require_once 'includes/funcoes.php';
$API_KEY = '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'; // If you're using Composer (recommended)
$mostra = $g->getCode($secret);
session_start();

$id = $_SESSION['id'];

$db = new db;
$db->where('idUsuario', $id);
$dados = $db->get('tbusuario', null, '*');
$db = null;

foreach ($dados as $d) {
    $nomepessoa = $d['nome'] . ' ' . $d['sobrenome'];
    $emailpessoa = $d['email'];
}

$email = new \SendGrid\Mail\Mail();
$email->setFrom("sistema.topobre@gmail.com", "Sistema To Pobre");
$email->addTo($emailpessoa, $nomepessoa);
$email->setSubject("Codigo de validação de e-mail");
$email->addContent(
    "text/html",
    '
    <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="qk51Jjn4bm3rn2Yb31Dxzb" data-mc-module-version="2019-10-22">   
      <tbody>    
        <tr>
          <td 
            style="background-color:#000000; 
            padding:10px 20px 10px 20px; 
            line-height:40px; text-align:justify;" 
            height="100%" 
            valign="top" 
            bgcolor="#000000">
            <div>
            <h1 style="text-align: center">
              <span style="color: #ffffff; font-size: 18px; font-family: verdana, geneva, sans-serif">
              <strong>Olá, '. $nomepessoa .' :) <br><p>Aqui está seu código de ativação !</p></strong>
              </span>
            </h1>
          </td>
        </tr>
      </tbody>
    </table>    
    <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-muid="qk51Jjn4bm3rn2Yb31Dxzb" data-mc-module-version="2019-10-22">
      <tbody>
        <tr>
          <td style="background-color:#ffffff; padding:50px 50px 10px 50px; line-height:22px; text-align:center;" height="100%" valign="top" bgcolor="#ffffff"><div><div style="font-family: inherit; text-align: inherit"><span style="font-size: 24px; font-family: verdana, geneva, sans-serif"><strong>' . $mostra . '</strong></span></div><div></div></div></td>
        </tr>
      </tbody>
    </table>
    '
);
$sendgrid = new \SendGrid($API_KEY);
$response = $sendgrid->send($email);
if ($response) {
    $_SESSION['msg'] = '<div class="alert alert-primary" role="alert"><i class="fas fa-check-square"></i> E-mail enviado com sucesso para <b>'.$emailpessoa.'</b>. Verifique sua caixa de entrada ou SPAM.</div>';
    addUsuarioToken($id, $mostra, 1);
    header('Location: token.php');
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-ban"></i>Ocorreu um erro ao enviar o código de verificação.</div>';
    header('Location: index.php');
}

