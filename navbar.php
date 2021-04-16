<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-inline-block" href="dashboard.php">
            <img src="assets/img/icon_logo.svg" width="30" height="30" class="d-inline-block align-top" alt="Logotipo da Smart Greenhouse">
            <span class="text-uppercase navbar_name">Smart Greenhouse</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" id="nav_dashboard" href="dashboard.php">Home</a>
                <a class="nav-item nav-link" id="nav_sensores" href="sensores.php">Sensores</a>
                <li class="nav-item dropdown" id="nav_historico">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Historico
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="sensor_luminosidade.php">Sensor Luminosidade</a>
                        <a class="dropdown-item" href="#">Sensor Temperatura</a>
                        <a class="dropdown-item" href="#">Sensor Humidade</a>
                        <a class="dropdown-item" href="#">Sensor Humidade Solo</a>
                    </div>
                </li>
            </div>

            <button class="btn btn-outline-light ml-auto btn_logout" type="submit" onclick="location.href='logout.php'">
                <i class="icon fas fa-sign-out-alt"></i>Logout
            </button>
        </div>
    </div>
</nav>