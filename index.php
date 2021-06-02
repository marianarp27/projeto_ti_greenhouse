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
                <?php include('ajax_tabelaSensores.php'); ?>
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
          //console.log("loading data - cards");
          $('#ajaxCards').html(data);
          }
        });
      }, 5000); // faz refresh a cada 5 segundos


      // Ajax da Tabela dos Sensores
      setInterval(function(){
        $.ajax({
              type: "get",
              url: "ajax_tabelaSensores.php",
              success:function(data)
              {
                //console.log("loading data - tabela");
                $('#ajaxTabelaSensores').html(data);
              }
        });
      }, 5000); // faz refresh a cada 5 segundos


    });
  </script>

</body>

</html>