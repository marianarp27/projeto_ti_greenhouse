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

// Ligação à Base de Dados (BD)
require_once('connection.php'); 
require_once('functions.php'); 

$dados= obterSensores();

// leitura das pastas da API's
//$path = 'api/files';

// scandir($path) — Lista os arquivos e diretórios que estão no caminho especificado
// array_diff - para tirar os pontos('.' e '..') do array
//$files = array_diff(scandir($path), array('..', '.'));


//Verfifica se existe a pasta com o nome que passa atraves do metodo GET por url
if (isset($_GET['nome'])) {
  $nome_sensor = $_GET['nome'];
  //$log = file_get_contents($path . "/" . $nome . "/log.txt");
  
  // *** verificação se a tabela/sensor existe na BD ***
  $sql = "SELECT 1 from $nome_sensor LIMIT 1";
  $result = $conn->query($sql);

  if ($result !== FALSE) { // caso o nome/sensor pedido exista na BD 
    $sql = "SELECT id, valor, hora FROM $nome_sensor ORDER BY id DESC"; 
    $db = $conn->query($sql);
    // usar as coisas 'selecionadas' lá em baixo no código
    
  } else { // caso não exista na BD 
    header("Location: 404.php");
    $conn->close();
  }
} else {
  header("Location: 404.php");
  $conn->close();
}

//Caso o caminho introduzido não exista é redirecionado para a págin index
/*if (!file_exists($path . "/" . $nome_sensor)) {
  header("Location: index.php");
  die();
}*/

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <?php include('head.php'); ?>
  <title>SG | Sensor de <?php echo ucfirst($nome_sensor) ?> </title>
  <!-- o 'ucfirst' serve para colocar a primeira letra do nome em maiúscula -->
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

        <!-- tipo Jumbotron da Dasboard mas com uso do 'Media object'-->
        <div class="media p-3 mb-4 rounded shadow-sm bg-white">
          <div class="media-body lh-100">
            <h4 class="mb-1">Histórico</h4>
            <h6 class="mb-1 text-success">Sensor <?php echo ucfirst($nome_sensor) ?></h6>
          </div>
          <img class="m-auto" width="50" src="<?php echo "public/img/icon_sensor_" . $nome_sensor . ".png" ?>" onerror="this.src='public/img/icon_sensor_default.png'" alt="Icon de <?php echo "$nome_sensor" ?>">
          <!--onerror - Coloca esta imagem por defeito caso a imagem definida anteriormente nao exista-->
        </div>

        <!-- Tabela dos Sensores -->
        <div class="card border-light rounded shadow-sm mt-3">
          <div class="card-body card_sensores mx-1 my-4">
            <table class="table " id="logTable">
              <thead>
                <tr>
                  <th scope="col">Data de Registo</th>
                  <th scope="col">Valor</th>
                </tr>
              </thead>
              <tbody id="data">
                <?php
                if ($db->num_rows > 0) {
                  while ($row = $db->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='align-middle'>" . $row['hora'] . "</td>";
                    echo "<td class='align-middle'>" . $row['valor'] . escreveSimbolo($nome_sensor) . "</td>";
                    echo "</tr>";
                  }
                } else { // caso o sensor pedido não conter nenhum dado
                  echo "Sensor sem resultados/dados a apresentar.";
                }
                ?>
              </tbody>
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

      $('#logTable').DataTable({
        "ordering": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json",
        }
      });

    });
  </script>

</body>

</html>