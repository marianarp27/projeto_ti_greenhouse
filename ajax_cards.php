<!-- CARD'S-->
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-4 row_cards">
  <?php
  // soluçãoencontrada para a leitura SESSION com ajax
  if (!isset($_SESSION['username'])){ 
    session_start();
  }

  require_once('connection.php');
  require_once('functions.php');

  $sql = "SELECT designacao,valor,hora FROM sensores";
  $result = mysqli_query($conn, $sql);
  $x = 0;
  while ($row = mysqli_fetch_row($result)) {

    $simbolo = escreveSimbolo($row[0]); // vai buscar o simbolo '%' ou 'ºC' dependendo do $nome*

    if ($x == 4) { // apenas aparecer no maximo 4 card's
      break;
    }
    $x++;
  ?>

    <div class="col col_card" id="div-to-refresh">
      <div class="card border-light">
        <div class="card-body rounded shadow-sm p-3">
          <div class="media mb-3">
            <img class="mr-3" width="50" src="public/img/icon_sensor_<?php echo $row[0] ?>.png" onerror="this.src='public/img/icon_sensor_default.png'" alt="Icon de <?php echo $row[0] ?>"">
            <div class=" media-body">
            <h4 class="mb-1"> <b> <?php echo ucfirst($row[1]) . $simbolo ?> </b> </h4>
            <h6 class="mb-1 text-muted"> <?php echo ucfirst($row[0]) ?> </h6>
          </div>
        </div>
        <!-- actualização com icon + link de historico-->
        <div class="pt-3 border-top">
          <span>
            <i class="far fa-calendar-alt mr-1 mt-2 text-muted"></i>
            <?php echo ucfirst($row[2]) ?>

            <?php if ($_SESSION['perfil'] == "admin") { ?>
              <a href="historico.php?nome=<?php echo $row[0] ?>"><i class="fas fa-angle-double-right span_icon"></i><span class="span_card">Historico</span></a>
            <?php } ?>

          </span>

        </div>
      </div>
    </div>
</div>

<?php }
  $conn->close(); ?>

</div>
<!-- FIM da secção das Card's-->


