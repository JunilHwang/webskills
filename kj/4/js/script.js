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
    
    $('body').on('mouseover', '.main-header #main-menu .menu li, .main-header .submenu', function(e){
        $('.main-hd .submenu').stop().slideDown(500);
    })
    
    $('body').on('mouseout', '.main-header #main-menu .menu li, .main-header .submenu', function(e){
        $('.main-hd .submenu').stop().slideUp(500);
    })
})

function link(url){
    document.location.href = url;
}

function frmSubmit(frm, url, msg, move){
    $.ajax({
        type : "POST",
        url : url,
        data : $(frm).serialize(),
        success : function(data){
            if(data){
                alert(data);
            } else {
                if(msg != '') alert(msg);
                if(move != '') link(move);
            }
        }
    })
    
    return false;
}