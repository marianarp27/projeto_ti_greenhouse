<?php
    // Ligação à Base de Dados (BD)
    require_once('connection.php'); 
    require_once('functions.php'); 

    // vai buscar o nome '*.php' da página em que se encontra -> para uso da class 'active'
    $url_file=basename($_SERVER['PHP_SELF']); 

    $dados= obterSensores();
?>

<div class="sidebar pt-3 pre-scrollable">
    <div class="nav flex-column nav-pills mx-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

        <a class="nav-link disabled shadow-sm"><i class="fas fa-home mr-2"></i>Dashboard</a>

        <a id="nav_home" class="nav-link shadow-sm" href="index.php">Home</a>

        

        <!-- código que lista todos os sensores do diretório da api -->
        <?php /* while ($row = mysqli_fetch_row($result)) { ?>
        <a class="nav-link shadow-sm <?php if($url_file == "historico.php"){
                     if($_GET['nome'] == "$row[0]") { ?> active <?php }} ?>"
            href="historico.php?nome=<?php echo "$row[0]"?>"><?php echo ucfirst($row[0]) ?></a>*/

        //Condição para que apenas o ADMIN tenha acesso ao histórico
        if ($_SESSION['perfil'] == "admin") {
        echo "
        <a class='nav-link disabled shadow-sm mt-3'>
            <i class='fas fa-list mr-2'></i>Histórico</a>
        ";

        foreach ($dados['sensores'] as $greenhouse) { ?>
        <a class="nav-link shadow-sm <?php if($url_file == "historico.php"){
                            if($_GET['nome'] == "$greenhouse->designacao") { ?> active <?php }} ?>"
            href="historico.php?nome=<?php echo "$greenhouse->designacao"?>"><?php echo ucfirst($greenhouse->designacao) ?></a>

        <?php 
                   }
                }
                ?>


        <!-- Fim da Condição do histórico -->
        <?php
            if (isLoggedIn()) {
                echo"
                    <a class='nav-link disabled shadow-sm mt-3'><i class='fas fa-user mr-2'></i> "
                    . ucfirst($_SESSION['username']) ." </a>
                ";
            }
     ?>

        <button class="btn btn-outline-success shadow-sm mb-3" type="submit" onclick="location.href='logout.php'">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
        </button>

    </div>
</div>