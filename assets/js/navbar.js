$(document).ready(function () {
    $(function () {
        // código para saber o caminho da página em que se está atualmente
        // window.location.pathname  -> "//TI/Projeto_TI/dashboard.php"
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);

        //condição para colocar a class 'active' quando se está na respetiva página

        switch (filename) {
            //caso Dashboard
            case "dashboard.php":
                $(".nav-item").removeClass('active');
                $("#nav_dashboard").addClass('active');
                break;
            //caso Sensores
            case "sensores.php":
                $(".nav-item").removeClass('active');
                $("#nav_sensores").addClass('active');
                break;
            //caso Historico
            case "sensor_luminosidade.php":
            //case "sensor_temperatura.php":
            //case "sensor_humidade.php":
                $(".nav-item").removeClass('active');
                $("#nav_historico").addClass('active');
                break;
        }

    })

});