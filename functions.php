<?php

//Função de login
function isLoggedIn() {
  require('connection.php'); 

  return isset($_SESSION['username']);
  return isset($_SESSION['perfil']);
}


//Função que adiciona o simbolo 'ºC' e '%' dependendo do seu nome
function escreveSimbolo($nome) {
    $simbolo = "";

    if ($nome == "luminosidade" || $nome == "humidade" || $nome == "humidade solo") {
      $simbolo = "%";
    }

    if ($nome == "temperatura") {
      $simbolo = "ºC";
    }

    return $simbolo;
}


//Função para obter os sensores
function obterSensores(){
  require('connection.php'); 
  $result = $conn->query("SELECT 1 from sensores"); 
  if ($result->num_rows == 0) {
    exit();
  }

  $query = "SELECT * FROM sensores";

  $result_set = $conn->query($query);

  if (!$result_set) {
    printf("erro na execução da query" . $conn->error);
    exit();
  }

  $dados = [];
  $dados['sensores'] = [];

  while ($greenhouse = $result_set->fetch_object()) {
      $dados['sensores'][] = $greenhouse;
  }

  $result_set->free();
  $conn->close(); /*fecha a ligação*/
  return $dados;
}


//Funcao de utilizadores
function obterUtilizadores(){
  require('connection.php'); 
  $result = $conn->query("SELECT 1 from utilizadores"); 
  if ($result->num_rows == 0) {
    exit();
  }

  $query = "SELECT * FROM utilizadores";

  $result_set = $conn->query($query);

  if (!$result_set) {
    printf("erro na execução da query" . $conn->error);
    exit();
  }

  $dados = [];
  $dados['utilizadores'] = [];

  while ($greenhouse = $result_set->fetch_object()) {
      $dados['utilizadores'][] = $greenhouse;
  }

  $result_set->free();
  $conn->close(); /*fecha a ligação*/
  return $dados;
}


//Funcao de utilizadores
function obterNomeUtilizadores(){
  require('connection.php'); 
  $result = $conn->query("SELECT 1 from utilizadores"); 
  if ($result->num_rows == 0) {
    exit();
  }

  $query = "SELECT username FROM utilizadores";

  $result_set = $conn->query($query);

  if (!$result_set) {
    printf("erro na execução da query" . $conn->error);
    exit();
  }

  $dados = [];
  $dados['utilizadores'] = [];

  while ($greenhouse = $result_set->fetch_object()) {
      $dados['utilizadores'][] = $greenhouse;
  }

  $result_set->free();
  $conn->close(); /*fecha a ligação*/
  return $dados;
}


?>