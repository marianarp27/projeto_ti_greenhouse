<?php 
  // perlongar o tempo para 5 minutos não dar erro de 'Maximum execution time of 30 seconds exceeded'
  // para assim conseguir fazer o uso do pedido ajax
  ini_set('max_execution_time', '300'); //300 segundos = 5 minutos
  set_time_limit(300);

  require_once('connection.php'); 
  require_once('functions.php'); 

  // soluçãoencontrada para a leitura SESSION com ajax
  if (!isset($_SESSION['username'])){ 
    session_start();
  }

  $dados = obterSensores();

?>


<!-- Tabela dos Sensores -->
<div class="card border-light rounded shadow-sm mt-3 mb-3">
  <div class="card-header bg-success text-white header-table">Tabela de Sensores</div>
  <div class="card-body card_sensores">
    <table class="table table-sm table-responsive-sm">
      <thead>
        <tr>
          <th scope="col">Dispositivo Iot</th>
          <th scope="col">Valor</th>
          <th scope="col">Data de Registo</th>
          <th scope="col">Estado</th>
          <?php
           if ($_SESSION['perfil'] == "admin") {  //No caso de ser administrador mostra o histórico
            echo "<th scope='col'>Histórico</th>";
          }

          if ( ($_SESSION['perfil'] == "admin") || ($_SESSION['perfil'] == "funcionario")  ) {  //No caso de ser administrador pode alterar o estado
            echo "<th scope='col'>Alterar Estado</th>";
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <!-- código para listar todo os sensores -->
        <?php
        foreach ($dados['sensores'] as $greenhouse) {
          

          $simbolo = escreveSimbolo($greenhouse->designacao); // vai buscar o simbolo '%' /'ºC' dependendo do nome do sensor
        ?>
          <tr>

            <th scope="row"> <?php echo ucfirst($greenhouse->designacao); ?> </th>

            <!-- o 'converteValor' chama função que transforma o valor da porta/janela de 1/0 em aberta/fechada
             e vai buscar tambem o simbolo '%' ou 'ºC' dependendo do nome do sensor -->
          <?php
             if( ($greenhouse->designacao) == "camara" ){  //No caso de ser camara ira mostrar uma imagem
                echo " <td> 
                          <img class='mr-3' width='70' src=' " . ($greenhouse->valor) . " ' 
                          onerror='this.src='public/img/icon_sensor_default.png'' alt='Imagem Camara'> 
                        </td>";

             } else {
             echo "<td style='height: 50px'>" . converteValor($greenhouse->designacao, $greenhouse->valor) . "</td> ";
            }
          ?>

            <!-- Data e hora da ultima atualização: -->
            <td> <?php echo $greenhouse->hora; ?> </td>

            <!-- Estado do Sensor: -->
            <td>
              <?php
              if ($greenhouse->valor  > 20) {
                echo "<span class= 'badge badge-pill badge-danger' >Alto</span>";
              } else {

                if (($greenhouse->valor == "aberta") || ($greenhouse->valor  == "abertas")) {
                  echo "<span class='badge badge-pill badge-success'>Aberta</span>";
                } else {

                  if ($greenhouse->valor == "ligada") {
                    echo "<span class='badge badge-pill badge-success'>Ligada</span>";
                  } else {

                    if (($greenhouse->valor >= 1) && ($greenhouse->valor <= 20)) {
                      echo "<span class='badge badge-pill badge-success'>Normal</span>";
                    } else {

                      if ($greenhouse->valor  == "fechada") {
                        echo "<span class='badge badge-pill badge-danger'>Fechado</span>";
                      } else {

                        if (($greenhouse->valor == "desligado") || ($greenhouse->valor == "desligados")) {
                          echo "<span class='badge badge-pill badge-danger'>Desligado</span>";
                        } else {

                          if ($greenhouse->valor == 0) {
                            echo "<span class='badge badge-pill badge-warning'>Baixo</span>";
                          }
                        }
                      }
                    }
                  }
                }
              }
              ?>
            </td>

          <?php
           if ($_SESSION['perfil'] == "admin")  {  // Se o utilizador for admin 
            echo "<td> 
              <a href='historico.php?nome=" . $greenhouse->designacao . "'>
              <span>Histórico</span> </a> 
              </td>";
            ?>

            <?php // botões para os atuadores
            $nome = $greenhouse->designacao;
            $valor = $greenhouse->valor;
              if ($nome == 'porta' || $nome == 'janela' || $nome == 'rega' || $nome == 'refrigerador' || $nome == 'aquecimento' || $nome == 'humidificador' || $nome == 'ventoinha') {
                echo "<td>";
                echo "<button id=btn" . $nome . " name='" . $nome . "' type='button' class='btn btn-outline-success btn-sm' onclick='btnEstado(this)' value='" . $valor . "'> Post " . ucfirst($nome) . " </button>";
                echo "</td>";
              } else{
                echo "<td class='text-muted'> - </td>";
              }
            ?>

          <?php
          } else { //Se o ficheiro log não existir não mostra o link para o histório
            echo "<td> </td>";
            echo "<td> </td> ";
          }

          if ( ($_SESSION['perfil'] == "admin") || ($_SESSION['perfil'] == "funcionario") ) {
            echo "<td> </td> ";
            echo "<td> </td> ";
          } else {
            echo "<td> </td>";
            echo "<td> </td> ";
          }
        }
          ?>
          </tr>

      </tbody>
    </table>
  </div>
</div>
<!-- FIM da Tabela dos Sensores -->

 <!-- JavaScript from botaoSendPost // para enviar POST -->
 <script src="public/js/botaoSendPost.js"></script>