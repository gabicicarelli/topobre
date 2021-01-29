<?php
session_start();
require_once '../db.php';
require_once '../funcoes.php';
$id = $_SESSION['id'];

deletar($id);
header('../../logout.php');

?>