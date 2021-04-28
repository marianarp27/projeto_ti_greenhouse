<?php
  session_start();

  if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
  }

  // leitura das API's
  $path = 'api/files';
  // scandir($path) — Lista os arquivos e diretórios que estão no caminho especificado
  $files = array_diff(scandir($path), array('..', '.')); // array_diff - para tirar os pontos('.' e '..') do array

  // função que adiciona o simbolo 'ºC' e '%' dependendo do seu nome
  function esreveSimbolo($nome) {
    $simbolo = "";
    if ($nome == "luminosidade" || $nome == "humidade" || $nome == "humidade solo" ) {
      $simbolo = "%";
    }       
    if ($nome == "temperatura" ) {
      $simbolo = "ºC";
    }
    return $simbolo;
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
        <div class="p-3 mb-3 rounded shadow-sm bg-white">
          <div class="lh-100">
            <h4 class="mb-1">Dashboard</h4>
            <h6 class="mb-1 text-success">Sistema de monitoramento</h6>
          </div>
        </div>
        

        <!-- CARD'S-->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-4 row_cards">

          <?php  
          // array defination
          $name = array("luminosidade", "temperatura", "Humidade", "porta");
          for ($i = 0; $i < 4; $i++) { 
              $get_nome = file_get_contents("api/files/" . $name[$i] . "/nome.txt");
              $get_valor = file_get_contents("api/files/" . $name[$i] . "/valor.txt");
              $get_hora = file_get_contents("api/files/" . $name[$i] . "/hora.txt");
              $get_img = "public/img/icon_sensor_" . $name[$i] . ".png";   // vai buscar o caminha para a img respativa   
              $simbolo = esreveSimbolo($get_nome); // vai buscar o simbolo '%' ou 'ºC' dependendo do $nome      
          ?>

            <!-- 'Card' + 'Media object' (formata img + texto frente a frente) -->
            <div class="col col_card">
              <div class="card border-light">
                <div class="card-body rounded shadow-sm p-3">
                  <div class="media mb-3">
                    <img class="mr-3" width="50" src="<?php echo "$get_img" ?>" onerror="this.src='public/img/icon_sensor_default.png'"  alt="Icon de  <?php echo "$get_nome" ?>">
                    <div class="media-body">
                      <h4 class="mb-1"> <b> <?php echo $get_valor . $simbolo ?> </b> </h4>
                      <h6 class="mb-1 text-muted"><?php echo ucfirst($get_nome)?></h6>
                    </div>
                  </div>
                  <!-- actualização com icon + link de historico-->
                  <div class="pt-3 border-top">
                    <span>
                      <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
                      <?php echo $get_hora ?>
                      <a href="historico.php?nome=<?php echo "$get_nome" ?>"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Histórico</span></a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
          <?php } ?>

        </div>
        <!-- FIM da secção das card's-->



        <!-- Tabela dos Sensores -->
        <div class="card border-light rounded shadow-sm mt-3">
            <div class="card-header bg-success text-white header-table">Tabela de Sensores</div>
                <div class="card-body card_sensores">
                    <table class="table table-sm table-responsive-sm">
                        <thead>
                            <tr>
                            <th scope="col">Dispositivo Iot</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Registo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Histórico</th>
                            </tr>
                        </thead>
                        <tbody>
                         <!-- código para listar todo os sensores -->
                          <?php 
                            foreach ($files as $value) {
                              $simbolo = esreveSimbolo($value); // vai buscar o simbolo '%' /'ºC' dependendo do nome do sensor
                          ?>
                          <tr>
                           <!-- o 'ucfirst' no '$value' serve para colocar a primeira letra do nome em maiúscula -->
                            <th scope="row"> <?php echo ucfirst($value) ?> </th>
                            <td  style="height: 50px"> <?php  print_r(file_get_contents($path . "/" . $value . "/valor.txt") . $simbolo) ?> </td>
                            <td> <?php  print_r(file_get_contents($path . "/" . $value . "/hora.txt")) ?> </td>
                            <td> <span class="badge badge-pill badge-success">Ativo</span> </td>
                            <td> <a href="historico.php?nome=<?php echo "$get_nome" ?>"> <span>Histórico</span> </a> </td>
                          </tr>

                          <?php
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