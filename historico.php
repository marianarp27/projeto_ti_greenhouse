<?php
  session_start();

  if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
  }

  /*if ($_SESSION['username'] == 'user') {
    header("Location: dashboard.php");
    die();
  }*/

  // leitura das API's
  if (isset($_GET['nome'])) {

    $get_nome = file_get_contents("api/files/" . $_GET['nome'] . "/nome.txt");
    $get_log = file_get_contents("api/files/" . $_GET['nome'] . "/log.txt");

  } else {
    echo "\n Faltam parâmetros no GET";
  }

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  refresh automático a cada 5 segundos -->
  <!--<meta http-equiv="refresh" content="5"> -->
  <title>Dashboard SG</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="public/css/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="public/css/geral.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="public/css/dashboard.css?v=<?php echo time(); ?>"> <!-- force the CSS to reload -- problema -> não estava ler o ficheiro -> ver com os stores -->
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="public/img/favicon.png"/>
  <!-- Font-Awesome (icons) -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
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
        <div class="p-3 mb-4 rounded shadow-sm bg-white">
          <div class="lh-100">
            <h4 class="mb-1">Histórico</h4>
            <h6 class="mb-1 text-success">Sensor <?php echo ucfirst($get_nome) ?></h6>
          </div>
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
                        <!-- Código para ler os valores (log) dependendo do 'nome' passado no URl -->
                        <?php
                          // função para filtrar caso algum array esteje 'vazio/sem valor' (não remove caso valor for '0')
                          function logFilter($var){
                            return ($var !== NULL && $var !== FALSE && $var !== "");
                          }
                          
                          // fazer a separação do ficheiro txt em array
                          $log = explode("\n", $get_log); 

                          // filtrar o array do log
                          $log_filter = array_filter($log, "logFilter");   

                          foreach ($log_filter as $data) {                   
                            $value = explode(";", $data); 
                            echo "<tr>";
                            echo "<td>$value[0]</td>"; 
                            echo "<td>$value[1]</td>";
                            echo "</tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>


      <!-- Fim do conteudo da página -->
    </div>
  </div>
  </div>





  <!-- JavaScript Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- JavaScript from NavBar -->
  <script type="text/javascript" src="public/js/navbar.js"></script>

</body>

</html>