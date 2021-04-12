<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("refresh:30; url=dashboard.php");
        die("Acesso restrito.");
    }

    //Ficheiros que guardam o valores
    $valor = file_get_contents("api/files/sensores/valor.txt");
    $hora = file_get_contents("api/files/sensores/hora.txt");
    $historico_valor = file_get_contents("api/files/sensores/valor.txt");
    $nome = file_get_contents("api/files/sensores/nome.txt");

    // leitura das API's ---- MARIANA ------------------------------------------------
    $valor_temp = file_get_contents("api/files/temperatura/valor.txt");
    $hora_temp = file_get_contents("api/files/temperatura/hora.txt");
    $nome_temp = file_get_contents("api/files/temperatura/nome.txt");
    //echo $nome_temp . ": " . $valor_temp . "Cº em " . $hora_temp;


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
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
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
                    <div class="card-header"><?php echo $nome  . ": " . $valor ?></div>
                    <div class="card-body"><img src="assets/img/dia.png" alt="Sol"></div>
                    <div class="card-footer">
                        <p>Actualização: <?php echo $hora ?> - <a href="#historico">Histórico</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header"><?php echo $nome_temp . ": " . $valor_temp . "º" ?></div>
                    <div class="card-body"><img src="assets/img/temperature.png" alt=""></div>
                    <div class="card-footer">
                        <p>Actualização: <?php echo $hora_temp ?> - <a href="#historico">Histórico</a></p>
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

     <!-- footer -->
    <?php include("assets/footer.php"); ?> 
        
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- JavaScript from NavBar -->
    <script type="text/javascript" src="assets/js/navbar.js"></script>

</body>

</html>