<?php
session_start();

// perlongar o tempo para 5 minutos não dar erro de 'Maximum execution time of 30 seconds exceeded'
// para assim conseguir fazer o uso do pedido ajax
ini_set('max_execution_time', '300'); //300 segundos = 5 minutos
set_time_limit(300);

// Ligação à Base de Dados (BD)
require_once('connection.php'); 
require_once('functions.php'); 


if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  die();
}
if ($_SESSION['perfil'] != 'admin') {
  header("Location: index.php");
  die();
}

// leitura das API's
if (isset($_GET['nome'])) {

  $nome_sensor = $_GET['nome'];
  
  $result = $conn->query("SELECT 1 FROM sensores WHERE designacao='$nome_sensor'"); 
  // caso o nome/sensor pedido não exista na BD 
  if ($result->num_rows == 0) { 
    header("Location: 404.php");
    $conn->close();
  }

} else {
  header("Location: 404.php");
  $conn->close();
}


?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <?php include('sections/head.php'); ?>
  <title>SG | Sensor de <?php echo ucfirst($nome_sensor) ?> </title>
  <!-- o 'ucfirst' serve para colocar a primeira letra do nome em maiúscula -->
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
        <div class="media p-3 mb-4 rounded shadow-sm bg-white">
          <div class="media-body lh-100">
            <h4 class="mb-1">Histórico</h4>
            <h6 class="mb-1 text-success">Sensor <?php echo ucfirst($nome_sensor) ?></h6>
          </div>
          <img id="imgSensor" class="m-auto" width="50" src="<?php echo imgNomeSrc($nome_sensor) ?>" 
          onerror="this.src='public/img/icon_sensor_default.png'" alt="Icon de <?php echo "$nome_sensor" ?>">
          <!--onerror - Coloca esta imagem por defeito caso a imagem definida anteriormente nao exista-->
        </div>


        <!-- Tabela dos Sensores -->
        <div class="card border-light rounded shadow-sm mt-3">
          <div class="card-body card_sensores mx-1 my-2">

            <table class="table" id="userTable">

              <thead>
                <tr>
                  <th scope="col">Data de Registo</th>
                  <th scope="col">Valor</th>
                </tr>
              </thead>

            </table>
          </div>
        </div>
        <!-- FIm da Tabela dos Sensores -->


      </div>
      <!-- Fim do conteudo da página -->
    </div>
  </div>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- JavaScript from NavBar -->
  <script src="public/js/navbar.js"></script>

  <!-- JavaScript necessário para a DataTable -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>

  <script>
    $(document).ready(function() {

      
      var table_historico = $('#userTable').DataTable({
        "ordering": false,
        "language": { // para colucar a tabela em portugues
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json",
        },
        'ajax': 'ajax_historico.php?nome=<?php echo $nome_sensor ?>',
        'dataType': 'json',
        'encode': true,
        'columns': [
          { data: "hora" },
          { data: "valor",
            //o 'render' vai  converter o numero do ATUADOR de '1/0'  para 'aberto/fechado' ou 'ligado/desligado'
            "render": function ( data, type, row ) { 
              // caso porta/janela 
              if ('<?php echo $nome_sensor ?>' === 'porta' || '<?php echo $nome_sensor ?>' === 'janela'){ 
                if(data == '1'){ // valor for '1' -> escreve aberta
                  return '<span> aberta </span>';
                }else{ // valor for '0' -> escreve fechada
                  return '<span> fechada </span>';
                }

              // caso rega/ventoinha 
              }else if('<?php echo $nome_sensor ?>' === 'rega' || '<?php echo $nome_sensor ?>' === 'ventoinha'){
                if(data == '1'){ // valor for '1' -> escreve ligada
                  return '<span> ligada </span>';
                }else{ // valor for '0' -> escreve desligada
                  return '<span> desligada </span>';
                }

              // caso refrigerador/aquecimento/humidificador 
              }else if('<?php echo $nome_sensor ?>' === 'refrigerador' || '<?php echo $nome_sensor ?>' === 'aquecimento' || '<?php echo $nome_sensor ?>' === 'humidificador'){
                if(data == '1'){ // valor for '1' -> escreve ligado
                  return '<span> ligado </span>';
                }else{ // valor for '0' -> escreve desligado
                  return '<span> desligado </span>';
                }

              // caso movimento
              }else if('<?php echo $nome_sensor ?>' === 'movimento' ){
                if(data == '1'){ // valor for '1' -> escreve movimento não detetado
                  return '<span> detetado </span>';
                }else{ // valor for '0' -> escreve movimento detetado
                  return '<span> não detetado </span>';
                }

              // caso camara muda para <img>
              }else if('<?php echo $nome_sensor ?>' === 'camara'){
                return '<span> <img width="150" src="' + (data) + ' " alt="Imagem da camara de vigilancia"> </span>';
              
              // caso for um SENSOR apresenta o valor do mesmo
              }else{
                return data;
              }
            }
           }
        ],
        'autoWidth': false
      });

      setInterval(function() {
        table_historico.ajax.reload(null, false); // user paging is not reset on reload
        //console.log("it's loading...");
      }, 4000);

      //fazer refresh à img para actualizar consualte aberta/fechada
      // apenas faz caso for um atuador
      if ('<?php echo $nome_sensor ?>' === 'porta'){ // *******  falta depois colocar os outros atuadores!! *******
        setInterval(function() {
          $("#imgSensor");
        }, 4000);
      }
      
      
      
    


    });

  </script>

</body>

</html>