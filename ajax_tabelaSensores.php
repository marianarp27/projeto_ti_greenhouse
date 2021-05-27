<?php 
  session_start();
  require_once('connection.php'); 
  require_once('functions.php'); 

  $dados = obterSensores();
?>


<!-- Tabela dos Sensores -->
<div class="card border-light rounded shadow-sm mt-3">
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

            <td style="height: 50px"> <?php echo $greenhouse->valor . $simbolo; ?> </td>

            <td> <?php echo $greenhouse->hora; ?> </td>

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
           if ($_SESSION['perfil'] == "admin") {  // Se o utilizador for admin 
            echo "<td> 
              <a href='historico.php?nome=" . $greenhouse->designacao . "'>
              <span>Histórico</span> </a> 
              </td>";
          } else { //Se o ficheiro log não existir não mostra o link para o histório
            echo "<td> </td>";
          }
        }
          ?>
          </tr>

      </tbody>
    </table>
  </div>
</div>
<!-- FIM da Tabela dos Sensores -->