<?php
session_start();

// Ligação à Base de Dados (BD)
require_once('connection.php'); 
require_once('functions.php');  

$dados = obterSensores();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include('sections/head.php'); ?>
   <!--  <meta http-equiv="refresh" content="30">  refresh automático a cada 30 segundos -->
    <link rel="stylesheet" href="public/css/index.css?v=<?php echo time(); ?>"> 
    <title>SG | Dashboard </title>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?php include('sections/navbar.php'); ?>
    <!-- Fim da Navbar -->

    <div class="d-flex">

        <!-- Sidebar -->
        <?php include('sections/sidenav.php'); ?>
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
              
              <!-- CARD'S ** Ajax -->
              <div id="ajaxCards">
                <?php include('ajax_cards.php'); ?>
              </div>
              <!-- FIM da secção das card's-->


              <!-- Tabela dos Sensores ** Ajax -->
              <div id="ajaxTabelaSensores">
                <?php /* include('ajax_tabelaSensores.php'); */ ?>
              </div>
              <!-- FIM da Tabela dos Sensores -->


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
                                    <?php
                                      if ($_SESSION['perfil'] == "admin") { //No caso de ser administrador mostra o histórico
                                        echo "<th scope='col'>Histórico</th>";
                                      }
                                      ?>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- código para listar todo os sensores -->
                                <?php
                                  foreach ($dados['sensores'] as $greenhouse) {
                                      $simbolo = escreveSimbolo($greenhouse->designacao); // vai buscar o simbolo '%' /'ºC' dependendo do nome do sensor
                                ?>
                                <tr>

                                    <th scope="row"> <?php echo ucfirst($greenhouse->designacao);?> </th>

                                    <td style="height: 50px"> <?php  echo $greenhouse->valor . $simbolo; ?> </td>

                                    <td> <?php echo $greenhouse->hora; ?> </td>

                                    <td>
                                        <?php 
                                          if ( ($greenhouse->valor) > 20) {
                                            echo "<span class= 'badge badge-pill badge-danger' >Alto</span>";
                                          } else {

                                            if ( ($greenhouse->valor == "aberta") || ($greenhouse->valor  == "abertas") ) {
                                              echo "<span class='badge badge-pill badge-success'>Aberta</span>";
                                              } else {

                                              if ($greenhouse->valor == "ligada") {
                                                echo "<span class='badge badge-pill badge-success'>Ligada</span>";
                                              } else {

                                                if ( ($greenhouse->valor >= 1) && ($greenhouse->valor <= 20) ) {
                                                  echo "<span class='badge badge-pill badge-success'>Normal</span>";
                                                } else {

                                                  if ( $greenhouse->valor  == "fechada" ) {
                                                    echo "<span class='badge badge-pill badge-danger'>Fechado</span>";
                                                  } else {

                                                    if ( ($greenhouse->valor == "desligado") || ($greenhouse->valor == "desligados") ) {
                                                      echo "<span class='badge badge-pill badge-danger'>Desligado</span>";
                                                    } else {

                                                      if ($greenhouse->valor == 0) {
                                                        echo "<span class='badge badge-pill badge-warning'>Baixo</span>";
                                                      }
                                                    }
                                                  }
                                                }
                                              }
                                            }
                                          }
                                        ?>
                                      </td>

                                      <?php
                                        if ($_SESSION['perfil'] == "admin") { // Se o utilizador for admin 
                                          echo "<td> 
                                                  <a href='historico.php?nome=" . $greenhouse->designacao . "'>
                                                    <span>Histórico</span> 
                                                  </a> 
                                                </td>";
                                        } else { //Se o ficheiro log não existir não mostra o link para o histório
                                          echo "<td> </td>";
                                        }
                                  }
                                   ?>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
              <!-- FIM da Tabela dos Sensores -->

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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    
  <script>   
    $(document).ready(function() {

      // Ajax das Card's
      setInterval(function(){
        $.ajax({
          type: "get",
          url: "ajax_cards.php",
          success:function(data)
          {
          //console.log("loading data..");
          $('#ajaxCards').html(data);
          }
        });
      }, 5000); // faz refresh a cada 5 segundos


      // Ajax da Tabela dos Sensores
      /*setInterval(function(){
        $.ajax({
              type: "get",
              url: "ajax_tabelaSensores.php",
              success:function(data)
              {
                console.log("loading data - tabela");
                $('#ajaxTabelaSensores').html(data);
              }
        });
      }, 5000); */ // faz refresh a cada 5 segundos


    });
  </script>

</body>

</html>