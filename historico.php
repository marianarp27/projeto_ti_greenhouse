<?php
    session_start();

    if(!isset ($_SESSION['username'])){
        header("refresh:30; url=index.php");
        die("Acesso restrito.");
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
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <!-- Font-Awesome (icons) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>

<body>    
    <!-- NavBar -->
    <?php include("assets/navbar.php"); ?> 
    
    <div class="jumbotron jumbotron-fluid">
        <div class="container">    
            <h1 class="display-4">Dashboard</h1>
            <p class="lead">Smart Greenhouse - Sistema de monitoramento</p>  
        </div>
    </div>
        

    
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Luminosidade: 80%</div>
                    <div class="card-body"><img src="assets/img/dia.png" alt="Sol"></div>
                    <div class="card-footer">
                        <p>Actualização: 2020/03/01 14:31 - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">22º</div>
                    <div class="card-body"><img src="assets/img/temperature.png" alt=""></div>
                    <div class="card-footer">
                        <p>Actualização: horas - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Porta: Fechada</div>
                    <div class="card-body"><img src="assets/img/door.png" alt=""></div>
                    <div class="card-footer">
                        <p>Actualização: 2020/03/01 14:31 - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>


    <!-- footer -->
    <?php include("assets/footer.php"); ?> 
        
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
    <!-- JavaScript from NavBar -->
    <script type="text/javascript" src="assets/js/navbar.js"></script>

</body>
</html>