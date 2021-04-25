<?php
  session_start();

  if (!isset($_SESSION['username'])) {
    header("refresh:30; url=index.php");
    die("Acesso restrito.");
  }

  // leitura das API's
  $valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
  $hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
  $nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");

  $valor_luminosidade = file_get_contents("api/files/luminosidade/valor.txt");
  $hora_luminosidade = file_get_contents("api/files/luminosidade/hora.txt");
  $nome_luminosidade = file_get_contents("api/files/luminosidade/nome.txt");
 

  //o uso do 'ucfirst' no '$nome_*' é para colocar a primeira letra em maiúscula
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
          <!-- card da Luminosidade + 'Media object' (formata img + texto frente a frente) -->
          <div class="col col_card">
            <div class="card border-light">
              <div class="card-body rounded shadow-sm p-3">
                <div class="media mb-3">
                  <img class="mr-3" width="50" src="public/img/icon_sensor_luminosidade.png" alt="Icon de Luminosidade">
                  <div class="media-body">
                    <h4 class="mb-1"> <b>80%</b> </h4>
                    <h6 class="mb-1 text-muted">Luminosidade</h6>
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top">
                  <span>
                    <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
                    2020/03/01 14:31
                    <a href="historico.php"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Historico</span></a>
                  </span>
                </div>
              </div>
            </div>
          </div>


          <!-- card da Temperatura -->
          <div class="col col_card">
            <div class="card border-light">
              <div class="card-body rounded shadow-sm p-3">
                <div class="media mb-3">
                  <img class="mr-3" width="50" src="public/img/icon_sensor_temperatura.png" alt="Icon de Temperatura">
                  <div class="media-body">
                    <h4 class="mb-1"> <b><?php echo $valor_temperatura . "ºC" ?></b> </h4>
                    <h6 class="mb-1 text-muted"><?php echo ucfirst($nome_temperatura) ?></h6>
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top">
                  <span>
                    <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
                    <?php echo $hora_temperatura ?>
                    <a href="historico.php"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Historico</span></a>
                  </span>
                </div>

              </div>
            </div>
          </div>

          <!-- card da Humidade-->
          <div class="col col_card">
            <div class="card border-light">
              <div class="card-body rounded shadow-sm p-3">
                <div class="media mb-3">
                  <img class="mr-3" width="50" src="public/img/icon_sensor_humidade.png" alt="Icon de Humidade">
                  <div class="media-body">
                    <h4 class="mb-1"> <b>80%</b> </h4>
                    <h6 class="mb-1 text-muted">Humidade</h6>
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top">
                  <span>
                    <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
                    2020/03/01 14:31
                    <a href="historico.php"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Historico</span></a>
                  </span>
                </div>

              </div>
            </div>
          </div>

          <!-- card Porta -->
          <div class="col col_card">
            <div class="card border-light">
              <div class="card-body rounded shadow-sm p-3">
                <div class="media mb-3">
                  <img class="mr-3" width="50" src="public/img/icon_sensor_porta.png" alt="Icon de Porta">
                  <div class="media-body">
                    <h4 class="mb-1"> <b>aberta</b> </h4>
                    <h6 class="mb-1 text-muted">Porta</h6>
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top">
                  <span>
                    <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
                    2020/03/01 14:31
                    <a href="historico.php"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Historico</span></a>
                  </span>
                </div>

              </div>
            </div>
          </div>

        </div>
        <!-- FIM da secção das card's-->



        <!-- Tabela dos Sensores -->
        <div class="card border-light rounded shadow-sm mt-3">
            <div class="card-header bg-success text-white header-table">Tabela de Sensores</div>
                <div class="card-body card_sensores">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Dispositivo Iot</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Actualização</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">Sensor de Luz</th>
                            <td>1000</td>
                            <td>2020/03/01 14:31</td>
                            </tr>
                            <tr>
                            <th scope="row"><?php echo ucfirst($nome_temperatura) ?></th>
                            <td><?php echo $valor_temperatura?>ºC</td>
                            <td><?php echo $hora_temperatura ?></td>
                            </tr>
                            <tr>
                            <th scope="row">Humidade</th>
                            <td>85%</td>
                            <td>2020/03/01 14:31</td>
                            </tr>
                            <tr>
                            <th scope="row">Luminosidade</th>
                            <td>80%</td>
                            <td>2020/03/01 14:31</td>
                            </tr>
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