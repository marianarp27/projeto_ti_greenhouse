<?php
    session_start();

    if(!isset ($_SESSION['username'])){
        header("refresh:30; url=index.php");
        die("Acesso restrito.");
    }

    // leitura das API's
    $valor_temp = file_get_contents("api/files/temperatura/valor.txt");
    $hora_temp = file_get_contents("api/files/temperatura/hora.txt");
    $nome_temp = file_get_contents("api/files/temperatura/nome.txt");

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
    <link rel="stylesheet" href="assets/css/geral.css">
    <link rel="stylesheet" href="assets/css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/dashboard.css?v=<?php echo time(); ?>"> <!-- force the CSS to reload -- problema -> não estava ler o ficheiro -> ver com os stores --> 
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <!-- Font-Awesome (icons) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>

<body class="bg-light">    
    <!-- NavBar -->
    <?php include("assets/navbar.php"); ?> 


    <div class="container">

        <!-- tipo Jumbotron da Dasboard mas com uso do 'Media object'-->
        <div class="p-3 my-3 text-white bg-success rounded shadow-sm">
            <div class="lh-100">
            <h4 class="mb-1 text-white">Dashboard</h4>
            <h6 class="mb-1 text-white">Sistema de monitoramento</h6>
            </div>
        </div>

        <!-- CARD'S-->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row_cards">
          <!-- card da Luminosidade + 'Media object' (formata img + texto frente a frente) -->
          <div class="col col_card">
              <div class="card border-light">
                <div class="card-body rounded shadow-sm p-3">
                  <div class="media mb-3">
                    <img class="mr-3" width="50" src="assets/img/icon_sensor_luminosidade.svg" alt="Icon de Luminosidade">
                    <div class="media-body">
                      <h4 class="mb-1"> <b>80%</b> </h4>
                      <h6 class="mb-1 text-muted">Luminosidade</h6>              
                    </div>
                  </div>
                  <!-- actualização com icon + link de historico-->
                  <div class="pt-3 border-top border-gray">
                    <span >
                      <i class="far fa-calendar-alt mr-1 text-muted"></i> 
                      2020/03/01 14:31 
                      <a href="sensor_luminosidade.php"><span class="span_card">Historico</span></a>
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
                  <img class="mr-3" width="50" src="assets/img/icon_sensor_temperatura.svg" alt="Icon de Temperatura">
                  <div class="media-body">
                    <h4 class="mb-1"> <b><?php echo $valor_temp . "ºC" ?></b> </h4>
                    <h6 class="mb-1 text-muted"><?php echo $nome_temp?></h6>              
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top border-gray">
                  <span >
                    <i class="far fa-calendar-alt mr-1 text-muted"></i> 
                    <?php echo $hora_temp ?>
                    <a href="#"><span class="span_card">Historico</span></a>
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
                  <img class="mr-3" width="50" src="assets/img/icon_sensor_humidade.svg" alt="Icon de Humidade">
                  <div class="media-body">
                    <h4 class="mb-1"> <b>80%</b> </h4>
                    <h6 class="mb-1 text-muted">Humidade</h6>              
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top border-gray">
                  <span >
                    <i class="far fa-calendar-alt mr-1 text-muted"></i> 
                    2020/03/01 14:31 
                    <a href="#"><span class="span_card">Historico</span></a>
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
                  <img class="mr-3" width="50" src="assets/img/icon_sensor_porta.svg" alt="Icon de Temperatura">
                  <div class="media-body">
                    <h4 class="mb-1"> <b>aberta</b> </h4>
                    <h6 class="mb-1 text-muted">Porta</h6>              
                  </div>
                </div>
                <!-- actualização com icon + link de historico-->
                <div class="pt-3 border-top border-gray">
                  <span >
                    <i class="far fa-calendar-alt mr-1 text-muted"></i> 
                    2020/03/01 10:45
                    <a href="#"><span class="span_card">Historico</span></a>
                  </span> 
                </div>
                  
              </div>
            </div>
          </div>

        </div>
        <!-- FIM da secção das card's-->

  

        <!-- Tabela dos Sensores -->
        <div class="card border-light rounded shadow-sm mt-2">
            <div class="card-header text-white bg-success">Tabela de Sensores</div>
            <div class="card-body card_sensores">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Dispositivo Iot</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Actualização</th>
                            <th scope="col">Estado Alertas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Sensor de Luz</th>
                            <td>1000</td>
                            <td>2020/03/01 14:31</td>
                            <td><span class="badge badge-pill badge-success">Ativo</span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_temp ?></th>
                            <td><?php echo $valor_temp ?>º</td>
                            <td><?php echo $hora_temp ?></td>
                            <td><span class="badge badge-pill badge-danger">Desativo</span></td>
                        </tr>
                        <tr>
                            <th scope="row">Humidade</th>
                            <td>85%</td>
                            <td>2020/03/01 14:31</td>
                            <td><span class="badge badge-pill badge-warning">warning</span></td>
                        </tr>
                        <tr>
                            <th scope="row">Luminosidade</th>
                            <td>80%</td>
                            <td>2020/03/01 14:31</td>
                            <td><span class="badge badge-pill badge-danger">Muito Forte</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- JavaScript from NavBar -->
    <script type="text/javascript" src="assets/js/navbar.js"></script>

</body>
</html>