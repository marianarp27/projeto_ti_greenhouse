<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-inline-block" href="#">
            <img src="assets/img/icon_logo.svg" width="30" height="30" class="d-inline-block align-top" alt="Logotipo da Smart Greenhouse">
            <span class="text-uppercase navbar_name">Smart Greenhouse</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Sensores</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Histórico
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Sensor Humidade</a>
                    <a class="dropdown-item" href="#">Sensor Temperatura</a>
                    <a class="dropdown-item" href="sensor_luminosidade.php">Sensor Luminozidade</a>
                  </div>
                </li>
            </ul>

            <button class="btn btn-outline-light ml-auto btn_logout" type="submit" onclick="location.href='logout.php'">
                <i class="icon fas fa-sign-out-alt"></i>Logout
            </button>
        </div>
    </div>
</nav>


