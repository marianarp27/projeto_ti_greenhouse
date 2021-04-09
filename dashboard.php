<?php
    session_start();

    if(!isset ($_SESSION['username'])){
        header("refresh:30; url=dashboard.php");
        die("Acesso restrito.");
    }

    
//Ficheiros que guardam o valores
$valor=file_get_contents("api/files/sensores/valor.txt");
$hora=file_get_contents("api/files/sensores/hora.txt");
$historico_valor=file_get_contents("api/files/sensores/valor.txt"); 
$nome=file_get_contents("api/files/sensores/nome.txt");

?>

<!DOCTYPE html>
<html lang="pt">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php require 'head.php'; ?>

    <body>
        <?php require 'header.php'; ?>
                
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
        <?php require 'footer.php'; ?>
    </body>
</html>