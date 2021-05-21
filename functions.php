<?php
/*
function coneccaoBD(){  
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 if ($conn->connect_errno) {
  $code = $conn->connect_errno;
  $message = $conn->connect_error;
  printf("<p>Connection error: %d %s</p>", $code, $message);
   return false;
  }

 mysqli_set_charset($conn, "utf8");
  return $conn;
}*/


/*
function isLoggedIn() {
    return isset($_SESSION['username']);
    return isset($_SESSION['perfil']);
}*/





// função que adiciona o simbolo 'ºC' e '%' dependendo do seu nome

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



function obterSensores(){
  //$conn = null;
  /*if (!($conn = coneccaoBD())) {
      exit();
  }*/
  require('connection.php'); 
  $sql = "SELECT 1 from sensores LIMIT 1";
  $result = $conn->query($sql); //verifica a conecção com a base de dados(BD)
  if ($result == FALSE) {
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



function obterUtilizadores(){
    /*$conn = null;
    if (!($conn = coneccaoBD())) {
        exit();
    } */
    require('connection.php'); 
    $sql = "SELECT 1 from utilizadores LIMIT 1";
    $result = $conn->query($sql); //verifica a conecção com a base de dados(BD)
    if ($result == FALSE) {
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
?>