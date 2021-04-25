<?php
    session_start();

    if(!isset ($_SESSION['username'])){
        header("refresh:30; url=index.php");
        die("Acesso restrito.");
    }

    if (isset($_GET['nome'])){
        $value = $_GET['nome'];
    } else {
        $value = null;
    }

    $files="api/files/$value/log.txt";
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
    <link rel="stylesheet" href="assets/css/geral.css?v=<?php echo time(); ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
    <!-- Font-Awesome (icons) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

</head>

<body class="bg-light">    
    
    <!-- NavBar -->
    <?php include('navbar.php'); ?>

    <!-- Conteudo da dashboard -->
    <div class="container">

        <!-- tipo Jumbotron da Dasboard mas com uso do 'Media object'-->
        <div class="media p-3 my-3 text-white rounded shadow-sm card-dashboard">
            <div class="media-body">
                <h4 class="mb-1 text-white text-capitalize"><?php echo $value ?></h4>
                <h6 class="mb-1 text-white">Historico</h6>              
            </div>
            <img class="m-auto" width="50" src="<?php echo "assets/img/icon_sensor_$value.svg"?> "  onerror="this.src='assets/img/icon_sensor_humidade.svg'" alt="Icon de Temperatura">
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Histórico</li>
                <li class="breadcrumb-item active" aria-current="page">Sensor <?php echo $value ?></li>
            </ol>
        </nav>


        <!-- Tabela do Histórico -->
        <div class="card border-light rounded shadow-sm mt-2">
            <div class="card-header text-white header-table">Histórico - Sensor de <?php echo $value ?></div>
            <div class="card-body card_sensores">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Actualização</th>
                            <th scope="col">Estado Alertas</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $lines = file($files);
                            foreach($lines as $file){
                                if($value!="." && $value!="..") { 
                                
                            $log="$file";
                            $data=explode(' ', $log);
                        ?>
                            <tr>
                                <td> <?php echo $data[2] ?> </td>
                                <td> <?php echo "$data[0] $data[1]"  ?> </td>
                                <td><span class="badge badge-pill badge-success">Ativo</span></td>
                            <tr>
                        <?php 
                                }
                            }
                        ?>
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