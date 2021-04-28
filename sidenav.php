<?php
    // leitura das API's
    $path = 'api/files';
    $files = array_diff(scandir($path), array('..', '.')); 

      // vai buscar o nome '*.php' da página 'corrente' -> para uso da class 'active'
      $url_file=basename($_SERVER['PHP_SELF']); 
?>

<div class="sidebar pt-3">
    <div class="nav flex-column nav-pills mx-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
        <a class="nav-link disabled shadow-sm"><i class="fas fa-home mr-2"></i>Dashboard</a>

        <a id="nav_home" class="nav-link shadow-sm" href="dashboard.php">Home</a>

        <a class="nav-link disabled shadow-sm mt-3"><i class="fas fa-list mr-2"></i>Histórico</a>

         <!-- Condição para que apenas o ADMIN tenha acesso ao histórico -->


         <a class="nav-link disabled shadow-sm mt-3"><i class="fas fa-list mr-2"></i>Histórico</a>
            <!-- código que lista todos os sensores do diretório da api -->
            <?php  foreach ($files as $value) { ?>              
                <a class="nav-link shadow-sm <?php if($url_file == "historico.php"){ if($_GET['nome'] == "$value") { ?> active <?php }} ?>"
                href="historico.php?nome=<?php echo "$value"?>"><?php echo ucfirst($value) ?></a>
            <?php } ?>
       

        <!-- Fim da Condição do histórico -->

        <a class="nav-link disabled shadow-sm mt-3"><i class="fas fa-cog mr-2"></i>Outros</a>

        <button class="btn btn-outline-success shadow-sm" type="submit" onclick="location.href='logout.php'">
            <i class="icon fas fa-sign-out-alt mr-2"></i>Logout
        </button>
    </div>
</div>