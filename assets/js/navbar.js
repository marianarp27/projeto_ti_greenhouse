
// Add active class
/*$(function(){
    $('.navbar-nav a').click(function(){ 
        //$(this).addClass('active').siblings().removeClass('active');
        $(".navbar-nav a.active").removeClass('active');
        $(this).addClass('active');
    }); 
})*/

/*$(function(){
    $('.navbar-nav a').click(function(){ 
        $(this).addClass('active').siblings().removeClass('active');
    }); 
})*/

$(document).ready(function () {
    $(function(){
        $('.nav-item').click(function(){ 
            $(this).addClass('active').siblings().removeClass('active');
        }); 
    })
});