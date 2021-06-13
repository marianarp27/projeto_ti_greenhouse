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

    if ($nome == "humidade") {
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
  // caso o atuador for luminosidade
  }else if($nome == 'luminosidade'){
    if ($valor == '1'){ // se for '1' converte para 'alta'
      $valorSensor = 'alta';
    }else{
      $valorSensor = 'baixa';
    }
  // caso o atuador for movimento
  }else if($nome == 'movimento'){
    if ($valor == '1'){ // se for '1' converte para 'detetado'
      $valorSensor = 'detetado';
    }else{
      $valorSensor = 'não detetado';
    }
  // caso não outros atuadores converte '1/0' para 'ligado/desligado'  
  }else if($nome == 'rega' || $nome == 'ventoinha'){
    if ($valor == '1'){ // se for '1' converte para 'ligada'
      $valorSensor = 'ligada';
    }else{
      $valorSensor = 'desligada';
    }
  }else if($nome == 'refrigerador' || $nome == 'aquecimento' || $nome == 'humidificador' ){
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

  // caso o atuador for refrigerador/aquecimento/humidificador
  }else if($nome == 'refrigerador' || $nome == 'aquecimento' || $nome == 'humidificador' ){
    if ($valor == '1'){ // se for '1' converte para 'aberta'
      $nomeImg = $nome.'_ligado';
    }else{
      $nomeImg = $nome.'_desligado';
    }

  // caso o atuador for rega/ventoinha
  }else if($nome == 'rega' || $nome == 'ventoinha'){
  if ($valor == '1'){ // se for '1' converte para 'aberta'
    $nomeImg = $nome.'_ligada';
  }else{
    $nomeImg = $nome.'_desligada';
  }
  // caso não seja nenhum desses atuadores, fica apenas o nome
  }else{
    $nomeImg = $nome;
  }
  $conn->close();
  return "public/img/icon_sensor_" . $nomeImg . ".png";
}


/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! MARIA VER PRIMEIRO !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */

//Função para mudar o estado (badge-pill) consuante os valores dos sensores/atuadores
function labelEstado($nome,$valor) {

  // caso o atuador for porta/janela
  if($nome == 'porta' || $nome == 'janela' || $nome == 'rega' || $nome == 'ventoinha'){

    if ($valor == '1'){ // caso for '1'
      $label = 'on';
      $badge = 'success';
    }else{ // caso for '0'
      $label = 'off';
      $badge = 'danger';
    }

  }else if($nome == 'luminosidade'){

    if ($valor <= '20') { // se for menor ou igual que 20 -> 'baixo'
      $label = 'baixo';
      $badge = 'warning';
    }else if($valor > '20' && $valor < '45') { // se estiver entre 20 - 45 -> 'normal'
      $label = 'normal';
      $badge = 'success';
    }else if($valor > '45' ) { // se for maior que 45 -> 'alto' // !!! se calhar basta aqui ter o 'else'
      $label = 'alto';
      $badge = 'danger';
    }
  }

  return "<span class= 'badge badge-pill badge-" . $badge . "' >" . $label . "</span>";
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