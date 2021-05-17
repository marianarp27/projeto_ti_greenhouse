<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  refresh automático a cada 5 segundos -->
  <!--<meta http-equiv="refresh" content="5"> -->
  <title>404</title>

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

        <div class="card text-center card_form shadow-sm bg-success border-0 rounded-lg m-5">

          <div class="card-body my-5">
            <h1 class="card-title text-white mb-3"> <b>404</b> </h1>
            <h4 class="card-text text-white">Oops! Página não encontrada!</h4>
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