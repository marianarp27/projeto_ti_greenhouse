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


?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <?php include('head.php'); ?>
  <title>SG | 404 </title>
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
 
         <!-- card do 404 -->
        <div class="card text-center shadow-sm bg-success border-0 rounded-lg m-5 ">
          <div class="card-body my-1">
            <h1 class="card-title text-white mb-0" > <b>404</b> </h1>
            <h4 class="card-text text-white">Oops! Página não encontrada!</h4>
            <img src="public/img/smart_greenhouse.svg" alt="imagem de uma estufa ilustrada" width="40%">
          </div>

        </div>

        <!-- Fim do conteudo da página -->
      </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- JavaScript from NavBar -->
    <script src="public/js/navbar.js"></script>


</body>

</html>