$(document).ready(function () {
    
    $(function () {
        // código para saber o caminho da página em que se está atualmente
        // window.location.pathname  -> "//TI/Projeto_TI/dashboard.php"
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
    
        //condição para colocar a class 'active' quando se está na respetiva página
        switch (filename) {
            //caso Dashboard/Home
            case "dashboard.php":
                $(".nav-link").removeClass('active');
                $("#nav_home").addClass('active');
                break;    
            // o case do hístórico está implementado em php na 'sidebar.php'  
        }

    });

    // ativar o 'toggle' da sidebar quando o botão é clicado
    $('#sidebarCollapse').on('click', function () {
        $('.sidebar').toggleClass('toggled');
        $('.content-page').toggleClass('toggled-content');

        if ($(window).width() < 710) {
            $('.content-page').toggleClass('page-opacity');
        }
    });

});