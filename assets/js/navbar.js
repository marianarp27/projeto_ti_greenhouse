$(document).ready(function () {

    // window.location.pathname  -> "//TI/projeto_it_greenhouse/dashboard.php"

    $(function () {
        // código para saber o caminho da página em que se está atualmente
        var local = window.location.pathname;

        //condição para colocar a class 'active' quando se está na respetiva página
        /*if(local == "//TI/projeto_it_greenhouse/dashboard.php"){
            $(".nav-link").removeClass('active');
            $("#nav_dashboard").addClass('active');
            
        } else if (local == "//TI/projeto_it_greenhouse/sensores.php"){
            $(".nav-link").removeClass('active');
            $("#nav_sensores").addClass('active');

        } else if (local == "//TI/projeto_it_greenhouse/sensor_luminosidade.php"){
            $(".nav-link").removeClass('active');
            $("#nav_historico").addClass('active');
        }else{
            $(".nav-link").removeClass('active');
            $("#nav_dashboard").addClass('active');
        }*/

        switch (local) {
            //caso Dashboard
            case "//TI/projeto_it_greenhouse/dashboard.php":
                $(".nav-item").removeClass('active');
                $("#nav_dashboard").addClass('active');
                break;
            //caso Sensores
            case "//TI/projeto_it_greenhouse/sensores.php":
                $(".nav-item").removeClass('active');
                $("#nav_sensores").addClass('active');
                break;
            //caso Historico
            case "//TI/projeto_it_greenhouse/sensor_luminosidade.php":
                $(".nav-item").removeClass('active');
                $("#nav_historico").addClass('active');
                break;
        }


    })

});