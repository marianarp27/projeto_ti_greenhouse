<div class="sidebar pt-3">
    <div class="nav flex-column nav-pills mx-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        
        <a class="nav-link disabled shadow-sm"><i class="fas fa-home mr-2"></i>Dashboard</a>

        <a id="nav_home" class="nav-link shadow-sm" href="dashboard.php">Home</a>

        <a class="nav-link disabled shadow-sm mt-3"><i class="fas fa-list mr-2"></i>Histórico</a>

        <a id="nav_luz" class="nav-link shadow-sm" href="historico.php?nome=luminosidade">Luminosidade</a>
        <a id="nav_temp" class="nav-link shadow-sm" href="historico.php?nome=temperatura">Temperatura</a>
        <a id="nav_humidade" class="nav-link shadow-sm" href="historico.php?nome=humidade">Humidade</a>

        <a class="nav-link disabled shadow-sm mt-3"><i class="fas fa-cog mr-2"></i>Outros</a>

        <button class="btn btn-outline-success shadow-sm" type="submit" onclick="location.href='logout.php'">
            <i class="icon fas fa-sign-out-alt mr-2"></i>Logout
        </button>
    </div>
</div>