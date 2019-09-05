$(function() {
    $('body').on('click', '.admin #header .hd-bot > ul > li:nth-child(1) a', function(e) {
        e.preventDefault();
        $('.submenu').slideToggle(500);
        setTimeout(function() {
            if ($('.submenu').css('display') == 'block') {
                $("#contents").css({ "margin-top": "160px" });
            } else {
                $("#contents").css({ "margin-top": "0" });
            }
        }, 600);
    })
    $('body').on('mouseover', '.main-header #main-menu .menu li, .main-header .submenu', function(e) {
        $('.main-hd .submenu').stop().slideDown(500);
    })
    $('body').on('mouseout', '.main-header #main-menu .menu li, .main-header .submenu', function(e) {
        $('.main-hd .submenu').stop().slideUp(500);
    })
    for (var i = 0; i < $(".banner-img > ul > li").length; i++) {
        $(".banner-pos > ul").append("<li></li>");
    }
    $(".banner-pos > ul li").eq(0).css({ "background-color": "#fff" });
    var b_len = $('.banner-img > ul > li').length;
    var all_wd = 100 * b_len;
    var one_wd = 100 / b_len;
    $('.banner-img > ul').css({ "width": all_wd + "%" });
    $('.banner-img > ul > li').css({ "width": one_wd + "%" });
    $('.banner-img > ul > li').eq(0).addClass('anishow');
    $('.banner-img > ul').attr('data-type', 'next');
    var btn = {
        on: function() {
            this.timer = setInterval(function() {
                animation('next');
            }, 3000);
        },
        off: function() {
            clearInterval(this.timer);
        }
    }
    btn.on();
    $('body').on('click', '.banner-img .banner-pos ul li', function(e) {
        var idx = $(this).index();
        btn.off();
        slide(idx);
        btn.on();
    })
})

function animation(arrow) {
    var idx = $('.banner-img > ul > li.anishow').index();
    var len = $('.banner-img > ul > li').length;
    var type = $('.banner-img > ul').attr('data-type');
    switch (arrow) {
        case 'next':
            idx + 1 == len ? slide(0) : slide(idx + 1);
            break;
    }
}

function slide(idx) {
    var len = $('.banner-img > ul > li').length;
    $('.banner-img > ul > li').removeClass('anishow');
    $('.banner-img > ul > li').eq(idx).addClass('anishow');
    $(".banner-pos > ul > li").css({ "background-color": "#000" });
    $(".banner-pos > ul > li").eq(idx).css({ "background-color": "#fff" });
    $('.banner-img > ul').stop().animate({ "margin-left": "-" + 100 * idx + "%" }, 1000);
}

function sorTable() {
    $('.menu-set-list > ul').sortable();
    $('.two-menu-wrap').sortable();
}

function mainVisual() {
    function v1() {
        $(this).parents("span").find('input').click();
    };

    function v2(e) {
        var files = e.target.files[0];
        $(this).parents('span').find('.f_name').text(files.name);
    };

    function v3() {
        var idx = $(this).parents("span").attr("data-idx");
        $.ajax({
            type: "POST",
            url: "/ajax/i-remove.php",
            data: { idx: idx },
            success: function(data) {
                location.reload();
            }
        });
    };

    function v4() {
        var arrow = $(this).attr("data-arrow");
        $.ajax({
            type: "POST",
            url: "/ajax/c-remove.php",
            data: { arrow: arrow },
            success: function(data) {
                location.reload();
            }
        });
    }
}

function tog() {
    $('body').on('click', '.f_upload .file-set', function(e) {
        $('.f_upload .file-set-area').toggle();
    })
}

function menuPos() {
    $('body').on('click', '.submenu .menu-pos1', function(e) {
        sessionStorage.setItem('menu', '1');
        $('.submenu .menu-pos1').hide();
        $('.submenu .menu-pos2').show();
    })
    $('body').on('click', '.submenu .menu-pos2', function(e) {
        sessionStorage.setItem('menu', '');
        $("#contents").css({ "margin-top": "0" });
        $('.submenu').slideUp(500);
        $('.submenu .menu-pos1').show();
        $('.submenu .menu-pos2').hide();
    })
    if (sessionStorage.getItem('menu') == '1') {
        $('.submenu').show();
        $("#contents").css({ "margin-top": "160px" });
        $('.submenu .menu-pos1').hide();
        $('.submenu .menu-pos2').show();
    }
}