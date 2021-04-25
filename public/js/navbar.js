$(document).ready(function () {
    $(function () {
        // código para saber o caminho da página em que se está atualmente
        // window.location.pathname  -> "//TI/Projeto_TI/dashboard.php"
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
        
        // saber o parametro "nome" passado no URL
        var params = new URLSearchParams(window.location.search);
        var name = params.get("nome");

        //condição para colocar a class 'active' quando se está na respetiva página
        switch (filename) {
            //caso Dashboard/Home
            case "dashboard.php":
                $(".nav-link").removeClass('active');
                $("#nav_home").addClass('active');
                break;
            //caso Historico
            case "historico.php":
                switch (name) {                    
                    case "luminosidade":
                        $(".nav-link").removeClass('active');
                        $("#nav_luz").addClass('active');
                        break;
                    case "temperatura":
                        $(".nav-link").removeClass('active');
                        $("#nav_temp").addClass('active');
                        break;
                    case "humidade":
                        $(".nav-link").removeClass('active');
                        $("#nav_humidade").addClass('active');
                        break;
                }
            break;          
        }

    });

    // ativar o 'toggle' da sidebar quando o botão é clicado
    $('#sidebarCollapse').on('click', function () {
        $('.sidebar').toggleClass('toggled');
        $('.content-page').toggleClass('toggled-content');
    });



});