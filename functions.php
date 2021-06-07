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

    if ($nome == "luminosidade" || $nome == "humidade" || $nome == "humidade solo" || $nome == "co2") {
      $simbolo = "%";
    }

    if ($nome == "temperatura") {
      $simbolo = "ºC";
    }

    return $simbolo;
}


//Função que converte o valor de 1/0 para aberto/fechado
function converteValor($nome, $valor) {
  // caso o atuador for porta/janela
  if($nome == 'porta' || $nome == 'janela'){
    if ($valor == '1'){ // se for '1' converte para 'aberta'
      $valorSensor = 'aberta';
    }else{
      $valorSensor = 'fechada';
    }
  // caso não outros atuadores converte '1/0' para 'ligado/desligado'
  }else if($nome == 'ac' || $nome == 'rega'){
    if ($valor == '1'){ // se for '1' converte para 'ligado'
      $valorSensor = 'ligado';
    }else{
      $valorSensor = 'desligado';
    }
  // caso não seja nenhum desses atuadores mostra o valor original do mesmo
  }else{
      $simbolo = escreveSimbolo($nome);
      $valorSensor = $valor.$simbolo;
    }

  return $valorSensor;
}

//Função para o nome do src da img -- colocar img atuadores 'dinamica'
function imgNomeSrc($nome) {
  require('connection.php'); 
  $sql = "SELECT valor FROM sensores WHERE designacao='$nome'";
  $db = $conn->query($sql);
  while ($row = $db->fetch_assoc()) { // buscar o valor
    $valor = $row['valor'];
  }

  // caso o atuador for porta/janela
  if($nome == 'porta' || $nome == 'janela'){
    if ($valor == '1'){ // se for '1' converte para 'aberta'
      $nomeImg = $nome.'_aberta';
    }else{
      $nomeImg = $nome.'_fechada';
    }
  // caso não seja nenhum desses atuadores, fica apenas o nome
  }else{
    $nomeImg = $nome;
  }
  $conn->close();
  return "public/img/icon_sensor_" . $nomeImg . ".png";
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