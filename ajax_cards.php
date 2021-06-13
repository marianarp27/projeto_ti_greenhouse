<!-- CARD'S-->
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-4 row_cards">
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



 

  $sql = "SELECT designacao,valor,hora FROM sensores WHERE designacao NOT LIKE 'movimento' ORDER BY designacao DESC LIMIT 8";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_row($result)) {

    // chama função que transforma o valor da porta/janela de 1/0 em aberta/fechada
    // e vai buscar tambem o simbolo '%' ou 'ºC' dependendo do nme do sensor
    $valorSensor = converteValor($row[0], $row[1]);

    // vai buscar a IMG consuante o seu valor (aberto/desligado)
    $imgSensor = imgNomeSrc($row[0]);

  ?>

    <div class="col col_card" id="div-to-refresh">
      <div class="card border-light">
        <div class="card-body rounded shadow-sm p-3">
          <div class="media">
            <img class="mr-3" width="50" src="<?php echo $imgSensor ?>" 
            onerror="this.src='public/img/icon_sensor_default.png'" alt="Icon de <?php echo $row[0] ?>"">
            <div class=" media-body">
            <h4 class="mb-1"> <b> <?php echo $valorSensor ?> </b> </h4>
            <h6 class="mb-1 text-muted"> <?php echo ucfirst($row[0]) ?> </h6>
          </div>
        </div>
        <!-- restrinção para 'user' // Apenas 'admin' e 'funcionario' tem acesso ao histórico-->
        <?php if ( $_SESSION['perfil'] == "admin" || $_SESSION['perfil'] == "funcionario" ) { ?>
        <!-- actualização com icon + link de historico-->
        <div class="mt-3 pt-3 border-top">
          <span>
            <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
            <?php echo ucfirst($row[2]) ?>           
              <a href="historico.php?nome=<?php echo $row[0] ?>"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Historico</span></a>
          </span>
        </div>
        <?php } ?>
      </div>
    </div>
</div>

<?php }
  $conn->close(); 
  ?>

</div>
<!-- FIM da secção das Card's-->


