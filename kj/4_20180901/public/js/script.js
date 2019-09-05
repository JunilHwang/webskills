$(function(){
    $('body').on('click', '.admin #header .hd-bot > ul > li:nth-child(1) a', function(e){
        e.preventDefault();
        
        $('.submenu').slideToggle(500);
        
        setTimeout(function(){
            if($('.submenu').css('display') == 'block'){
                $("#contents").css({"margin-top" : "160px"});
            } else {
                $("#contents").css({"margin-top" : "0"});
            }
            
        }, 600);
    })
})