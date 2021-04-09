
<?php
    session_start();

    if(!isset ($_SESSION['username'])){
        header("refresh:30; url=dashboard.php");
        die("Acesso restrito.");
    }

    
//Ficheiros que guardam o valores
$valor=file_get_contents("api/files/sensores/valor.txt"); //Vai buscar o ficheiro txt
$hora=file_get_contents("api/files/sensores/hora.txt");
$historico_valor=file_get_contents("api/files/sensores/valor.txt"); 
$nome=file_get_contents("api/files/sensores/nome.txt");

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SG</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style_dashboard.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <!-- Font-Awesome (icons) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<body>    
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand d-inline-block" href="#">
                <img src="assets/img/icon_logo.svg" width="30" height="30" class="d-inline-block align-top" alt="Logotipo da Smart Greenhouse">
                <span class="text-uppercase navbar_name">Smart Greenhouse</span> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home</a>
                <a class="nav-item nav-link" href="#">Histórico</a>
                <a class="nav-item nav-link" href="#">Sensores</a>
            </div>
            <button class="btn btn-outline-light ml-auto btn_logout" type="submit"><i class="icon fas fa-sign-out-alt"></i><a href="logout.php">Logout </a></button>
            </div>
        </div>
    </nav>

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
                    <div class="card-header"><?php echo $nome  . ": " . $valor ?></div>
                    <div class="card-body"><img src="../lab02_icons/dia.png" alt="Sol"></div>
                    <div class="card-footer">
                        <p>Actualização: <?php echo $hora?> - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Temperatura: 22%</div>
                    <div class="card-body"><img src="../lab02_icons/temperature.png" alt=""></div>
                    <div class="card-footer">
                        <p>Actualização: 2020/03/01 14:31 - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Porta: Fechada</div>
                    <div class="card-body"><img src="../lab02_icons/door.png" alt=""></div>
                    <div class="card-footer">
                        <p>Actualização: 2020/03/01 14:31 - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container">

        <div class="card">
            <div class="card-header">Luminosidade: 80%</div>
            <div class="card-body">
                <table class="table">
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
                                <td> <?php echo $nome ?> </td>
                                <td> <?php echo $valor ?> </td>
                                <td> <?php echo $hora ?> </td>
                                <td> <span class="badge badge-pill badge-danger">Desativo</span> </td>
                              </tr>
                              <tr>
                    <tr>
                        <th scope="row">Sensor de Luz</th>
                        <td>1000</td>
                        <td>2020/03/01 14:31</td>
                        <td><span class="badge badge-pill badge-success">Ativo</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Temperatura</th>
                        <td>22%</td>
                        <td>2020/03/01 14:31</td>
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

</body>
</html>