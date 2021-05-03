<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  die();
}
if ($_SESSION['username'] != 'admin') {
  header("Location: index.php");
  die();
}

// leitura das pastas da API's
$path = 'api/files';

// scandir($path) — Lista os arquivos e diretórios que estão no caminho especificado
// array_diff - para tirar os pontos('.' e '..') do array
$files = array_diff(scandir($path), array('..', '.'));

//Verfifica se existe a pasta com o nome que passa atraves do metodo GET por url
if (isset($_GET['nome'])) {
  $nome = $_GET['nome'];
  $log = file_get_contents($path . "/" . $nome . "/log.txt");
}

// função que adiciona o simbolo 'ºC' e '%' dependendo do seu nome
function escreveSimbolo($nome)
{
  $simbolo = "";
  if ($nome == "luminosidade" || $nome == "humidade" || $nome == "humidade solo") {
    $simbolo = "%";
  }
  if ($nome == "temperatura") {
    $simbolo = "ºC";
  }
  return $simbolo;
}

//Caso o caminho introduzido não exista é redirecionado para a págin index
if( !file_exists($path . "/" . $nome) ) {
  header("Location: index.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include('head.php'); ?>
    <title>SG | Sensor de <?php echo ucfirst($nome) ?> </title>
    <!-- o 'ucfirst' serve para colocar a primeira letra do nome em maiúscula -->
</head>


<body class="bg-light">

    <!-- Navbar -->
    <?php include('navbar.php'); ?>
    <!-- Fim da Navbar -->


    <div class="d-flex">

        <!-- Sidebar -->
        <?php include('sidenav.php'); ?>
        <!-- Fim da Sidebar -->


        <!-- Conteudo da página -->
        <div class="container-fluid content-page">
            <div class="content pt-3">

                <!-- tipo Jumbotron da Dasboard mas com uso do 'Media object'-->
                <div class="media p-3 mb-4 rounded shadow-sm bg-white">
                    <div class="media-body lh-100">
                        <h4 class="mb-1">Histórico</h4>
                        <h6 class="mb-1 text-success">Sensor <?php echo ucfirst($nome) ?></h6>
                    </div>
                    <img class="m-auto" width="50" src="<?php echo "public/img/icon_sensor_" . $nome . ".png" ?>"
                        onerror="this.src='public/img/icon_sensor_default.png'" alt="Icon de <?php echo "$nome" ?>">
                    <!--onerror - Coloca esta imagem por defeito caso a imagem definida anteriormente nao exista-->
                </div>

                <!-- Tabela dos Sensores -->
                <div class="card border-light rounded shadow-sm mt-3">
                    <div class="card-header bg-success text-white header-table">Tabela de Histórico</div>
                    <div class="card-body card_sensores">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Data de Registo</th>
                                    <th scope="col">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                  if( ( !file_exists($path . "/" . $nome . "/log.txt") )  ) { //Verifica se existem os ficheiros 
                ?>
                                <tr class="table-danger">
                                    <!--Se os ficheiros não existirem escreve esta mensagem -->
                                    <td colspan="2"> Os ficheiros que armazenam os valores referentes ao sensor
                                        <?php echo $nome; ?> não existem </td>
                                </tr>

                                <?php
                  } else { //Caso os ficheiros existam coloca os valores na tabela 
                ?>
                                <tr class="table-success"> <!--Coloca o valor atual destacado a verde e na primeira linha da tabela-->
                                    <?php
                    $valor=file_get_contents($path . "/" . $nome . "/valor.txt");
                    $hora=file_get_contents($path . "/" . $nome . "/hora.txt");
                    $dados=[$valor, $hora]; //Array que guarda o valor e a hora
                  ?>

                                    <td>
                                        <?php print_r($hora) ?>
                                    </td>
                                    <td>
                                        <?php print_r($valor . escreveSimbolo($nome)) ?>
                                    </td>

                                    <!-- Código para ler os valores (log) dependendo do 'nome' passado no URl -->
                                    <?php

                  // função para filtrar caso algum ficheiro esteje 'vazio/sem valor' (não remove caso valor for '0')
                  function logFilter($var) {
                    return ($var !== NULL && $var !== FALSE && $var !== "");
                  }

                  // fazer a separação do ficheiro txt em array, separando sempre que encontra um \n
                  $log1 = explode("\n", $log);

                  // filtra o array do log -> remove linhas vazias
                  //'array_map' + trim -> remove os 'espaços extras' que ficam no array
                  //'array_filter' -> remove os valores NULL
                  $log_filter = array_map('trim', array_filter($log1, "logFilter"));

                  arsort($log_filter); //Ordenar os valores do ficheiro 
                  $log_filter = array_unique($log_filter); //Caso haja valores de data/hora exatamebte iguais lista apenas uma das linhas

                  foreach ($log_filter as $data) {
                    $value = explode(";", $data); 
                      if( array_diff($dados, $value) ){ // Compara se o valor atual é igual ao dos logs e se for nao lista porque já foi listado anteriormente 
                ?>
                                <tr>
                                    <td> <?php echo $value[0]; ?> </td> <!-- data de registo -->
                                    <td> <?php echo $value[1] . escreveSimbolo($nome) ;  ?> </td> <!-- valor -->
                                </tr>
                                <?php
                    }
                  }
                ?>
                            </tbody>
                            <?php
                }
              ?>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Fim do conteudo da página -->
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- JavaScript from NavBar -->
    <script src="public/js/navbar.js"></script>

</body>

</html>