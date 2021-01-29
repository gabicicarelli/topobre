<?php

// FUNCÕES
function validaCPF($cpf) 
  {
  
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
    
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

  }
function db2br($data)
  {
    $t = explode(' ', $data);
    $hora = $t[1];
    $t = explode('-', $t[0]);
    return $t[2] . '/' . $t[1] . '/' . $t[0] . ' ' . $hora;
  }
function br2bd($data)
  {
    $mydata = substr($data, 6, 4) . "-" . substr($data, 3, 2) . "-" . substr($data, 0, 2);
    return $mydata;
  }
function money($valor)
  {
    if (!isset($valor)) {
      return '0,00';
    } else {
      $oper = '';
      if ($valor < 0) {
        $valor = str_replace('-', '', $valor);
        $oper = '-';
      }
      $arr = explode('.', $valor);
      $val = '';
      for ($x = strlen($arr[0]); $x > 0; $x--) {
        if (strlen($arr[0]) - $x > 0 && $x % 3 == 0) {
          $val .= '.';
        }
        $val .= substr($arr[0], strlen($arr[0]) - $x, 1);
      }
      return $oper . $val . ',' . (!isset($arr[1]) ? '00' : (strlen($arr[1]) == 1 ? str_pad($arr[1], 2, '0') : substr($arr[1], 0, 2)));
    }
  }
function db2dt($data)
  {
    return substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);
  }
function getUserIP()
  {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if (filter_var($client, FILTER_VALIDATE_IP)) {
      $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
      $ip = $forward;
    } else {
      $ip = $remote;
    }
    return $ip;
  }

function makeHash($a, $b)
  {
    return hash('sha512', $a . $b);
  }
function logout()
  {
    session_start();
    session_destroy();
    header("location: login.php");
  }

function addUsuarioToken($id, $token, $ok)
  {
    $db = new db;
    $d = array(
      'idUsuario' => $id,
      'token' => $token,
      'sucesso' => $ok,
      'dtEnvio' => DATE('Y-m-d H:i:s')
    );
    $db->insert('tbusuariotoken', $d);
    $db = null;
  }
function addLog($id, $log, $tipo)
  {
    $db = new db;
    $d = array(
      'idUsuario' => $id,
      'nome' => $log,
      'tipo' => $tipo,
      'ip' => getUserIP(),
      'dtlog' => DATE('Y-m-d H:i:s')
    );
    $db->insert('tblog', $d);
    $db = null;
  }
function deletar($id)
  {
    $db = new db;
    $db->where('idUsuario', $id);
    $db->delete('tbusuario');
    $db = null;
  }
