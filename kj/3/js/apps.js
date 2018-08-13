var db;

var apps = {
	init : function(){
		apps.initTrigger();
        ani_control();
		csstype();
		var data = {
                userid : 'admin',
                pw : '1234',
                username : '관리자'
            }
            
	    localStorage.setItem("admin", JSON.stringify(data));
		
        var req = indexedDB.open("20180629", 2);
        
        req.onupgradeneeded = function(e){
            var thisDB = e.target.result;
            
            var html = thisDB.createObjectStore('html', {keyPath : 'type'});
        }
        
        req.onsuccess = function(e){
            db = e.target.result;
            
            var req = db.transaction(['html'], 'readwrite').objectStore('html').openCursor();
            
            req.onsuccess = function(e){
                var result = e.target.result;
                
                if(result){
                    if(result.key == 'gallery'){
                        $('.gallery-area').html(result.value.html);
                    } else if(result.key == 'ptf'){
                        $('#portfolio').html(result.value.html);
                    }
                    
                    
                    result.continue();
                }
            }
        }
        
//        로그인 체크
        if(!sessionStorage['userid']){
            $('.mb-btn .login-btn').show();
            $('.mb-btn .join-btn').show();
            $('.mb-btn .logout-btn').hide();
        } else {
            $('.mb-btn .login-btn').hide();
            $('.mb-btn .join-btn').hide();
            $('.mb-btn .logout-btn').show();
        }
        
		function csstype(){
			$(".preloader:nth-child(1)").fadeOut(1000);
			$(".element > div").hide();
			$(".fadeInUp").css({"transform" : "translate(0,30px)"});
			$(".fadeInLeft").css({"transform" : "translate(-30px)"});
			$(".fadeInRight").css({"transform" : "translate(30px)"});
			$(".bounceIn ").css({"transform" : "scale(0.3)"});
			$("textarea").css({"style=height" : "300px","resize": "vertical"});
			$(".wow").css({"opacity" : "0"});
		}

			setTimeout(function(e){
				var d_top = $(document).scrollTop();
				var d_bot = $(document).scrollTop() + $(window).height();

				var el = $(".wow");
				$.each(el, function(k, v){
					var el_top = $(v).offset().top;
					var el_height = $(v).height();
					var el_bot = el_top + el_height;
					var setTime = $(v).attr("data-wow-delay");
					$(v).css({"transition" : setTime});

					if(el_top <= d_bot && d_top <= el_bot){
						var fadeIn = $(v).hasClass('fadeIn');
						var fadeInUp = $(v).hasClass('fadeInUp');
						var fadeInLeft = $(v).hasClass('fadeInLeft');
						var fadeInRight = $(v).hasClass('fadeInRight');
						var bounceIn = $(v).hasClass('bounceIn');
						
						if(fadeIn){
							box(v);
						}else if(fadeInUp){
							boxup(v);
						}else if(fadeInLeft){
							boxleft(v);
						}else if(fadeInRight){
							boxright(v);
						}else if(bounceIn){
							titleType(v);
						}
					}

				})




				if(0 <= d_top && ($("#home").offset().top + $("#home").height()) >= d_top){
                    
					$(".navbar-nav > li a").css({"color" : "#777"});
                    
					$(".navbar-nav > li:nth-child(1) a").css({"color" : "#28a7e9"});
                    
				}else if($("#about").offset().top <= d_top && $("#about").offset().top + $("#about").height() >= d_top){
                    
					$(".navbar-nav > li a").css({"color" : "#777"});
                    
                    
					$(".navbar-nav > li:nth-child(2) a").css({"color" : "#28a7e9"});
                    
				}else if($("#team").offset().top <= d_top && $("#team").offset().top + $("#team").height() >= d_top){
                    
//                    functionf 
                    
					$(".navbar-nav > li a").css({"color" : "#777"});
                    
					$(".navbar-nav > li:nth-child(3) a").css({"color" : "#28a7e9"});
                    
                    
				}else if($("#service").offset().top <= d_top && $("#service").offset().top + $("#service").height() >= d_top){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(4) a").css({"color" : "#28a7e9"});
				}else if($("#portfolio").offset().top <= d_top && $("#portfolio").offset().top + $("#portfolio").height() >= d_top){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(5) a").css({"color" : "#28a7e9"});
				}else if($("#contact").offset().top <= d_top && $("#contact").offset().top + $("#contact").height() >= d_top){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(6) a").css({"color" : "#28a7e9"});
				}








				var home = $("#home").offset().top;
					$('body').on('click', 'nav li:nth-child(1) a', function(e){
						e.preventDefault();
						$("html").stop().animate({scrollTop : home}, 800);
					})

					var about = $("#about").offset().top;
					$('body').on('click', 'nav li:nth-child(2) a', function(e){
						e.preventDefault();
						$("html").stop().animate({scrollTop : about}, 800);
					})


					var team = $("#team").offset().top;
					$('body').on('click', 'nav li:nth-child(3) a', function(e){
						e.preventDefault();
						$("html").stop().animate({scrollTop : team}, 800);
					})


					var service = $("#service").offset().top;
					$('body').on('click', 'nav li:nth-child(4) a', function(e){
						e.preventDefault();
						$("html").stop().animate({scrollTop : service}, 800);
					})

					var portfolio = $("#portfolio").offset().top;
					$('body').on('click', 'nav li:nth-child(5) a', function(e){
						e.preventDefault();
						$("html").stop().animate({scrollTop : portfolio}, 800);
					})

					var contact = $("#contact").offset().top;
					$('body').on('click', 'nav li:nth-child(6) a', function(e){
						e.preventDefault();
						$("html").stop().animate({scrollTop : contact}, 800);
					})



			})


			$(window).scroll(function(){
                
				var scrollTop = $(this).scrollTop();
                
                
				var scrollBot = $(this).scrollTop() + $(window).height();

                
                
				var el = $(".wow");
                
				$.each(el, function(k, v){
					var el_top = $(v).offset().top;
					var el_height = $(v).height();
					var el_bot = el_top + el_height;

					if(el_top <= scrollBot && scrollTop <= el_bot){
						var fadeIn = $(v).hasClass('fadeIn');
						var fadeInUp = $(v).hasClass('fadeInUp');
						var fadeInLeft = $(v).hasClass('fadeInLeft');
						var fadeInRight = $(v).hasClass('fadeInRight');
						var bounceIn = $(v).hasClass('bounceIn');

						if(fadeIn){
							box(v);
						}else if(fadeInUp){
							boxup(v);
						}else if(fadeInLeft){
							boxleft(v);
						}else if(fadeInRight){
							boxright(v);
						}else if(bounceIn){
							titleType(v);
						}
					}
                    
                    





				})
				


				var navr = $(".navbar").offset().top;

				if(scrollTop != 0){
                    
                    
					$(".navbar").css({"position" : "fixed", "top" : "0", "left" : "0"});
				}else{
                    
					$(".navbar").css({"position" : "", "top" : "0", "left" : "0"});
				}



				if(0 <= scrollTop && ($("#home").offset().top + $("#home").height()) >= scrollTop){
					
                    $(".navbar-nav > li a").css({"color" : "#777"});
                    
                    
					$(".navbar-nav > li:nth-child(1) a").css({"color" : "#28a7e9"});
				}else if($("#about").offset().top <= scrollTop && $("#about").offset().top + $("#about").height() >= scrollTop){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(2) a").css({"color" : "#28a7e9"});
				}else if($("#team").offset().top <= scrollTop && $("#team").offset().top + $("#team").height() >= scrollTop){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(3) a").css({"color" : "#28a7e9"});
				}else if($("#service").offset().top <= scrollTop && $("#service").offset().top + $("#service").height() >= scrollTop){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(4) a").css({"color" : "#28a7e9"});
				}else if($("#portfolio").offset().top <= scrollTop && $("#portfolio").offset().top + $("#portfolio").height() >= scrollTop){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(5) a").css({"color" : "#28a7e9"});
				}else if($("#contact").offset().top <= scrollTop && $("#contact").offset().top + $("#contact").height() >= scrollTop){
					$(".navbar-nav > li a").css({"color" : "#777"});
					$(".navbar-nav > li:nth-child(6) a").css({"color" : "#28a7e9"});
				}




				var home = $("#home").offset().top;
				$('body').on('click', 'nav li:nth-child(1) a', function(e){
					e.preventDefault();
					$("html").stop().animate({scrollTop : home}, 800);
				})

				var about = $("#about").offset().top;
				$('body').on('click', 'nav li:nth-child(2) a', function(e){
					e.preventDefault();
					$("html").stop().animate({scrollTop : about}, 800);
				})


				var team = $("#team").offset().top;
				$('body').on('click', 'nav li:nth-child(3) a', function(e){
					e.preventDefault();
					$("html").stop().animate({scrollTop : team}, 800);
				})


				var service = $("#service").offset().top;
				$('body').on('click', 'nav li:nth-child(4) a', function(e){
					e.preventDefault();
					$("html").stop().animate({scrollTop : service}, 800);
				})

				var portfolio = $("#portfolio").offset().top;
				$('body').on('click', 'nav li:nth-child(5) a', function(e){
					e.preventDefault();
					$("html").stop().animate({scrollTop : portfolio}, 800);
				})

                
				var contact = $("#contact").offset().top;
                
				$('body').on('click', 'nav li:nth-child(6) a', function(e){
                    
					e.preventDefault();
					$("html").stop().animate({scrollTop : contact}, 800);
				})

			})

		function box(idx_r){
			var Time = $(idx_r).attr("data-wow-delay");
			if(Time == "1.3s" ){
				setTimeout(function(e){
					$(idx_r).css({"opacity" : "1"});
				}, 500);
			}else if(Time == "1.6s"){
				setTimeout(function(e){
					$(idx_r).css({"opacity" : "1"});
				}, 1000);
			}else if(Time == "0.6s"){
				setTimeout(function(e){
					$(idx_r).css({"opacity" : "1"});
				}, 500);
			}else if(Time == "0.9s"){
				setTimeout(function(e){
					$(idx_r).css({"opacity" : "1"});
				}, 1000);
			}
			setTimeout(function(e){
				$(idx_r).css({"transform" : "translate(0)"})
			});
		}
		function boxleft(idx_r){
			setTimeout(function(e){
				var setTime = $(idx_r).attr("data-wow-delay");
				$(idx_r).css({"opacity" : "1" ,"transform" : "translate(0)", "transition" : setTime})
			}, 500);
		}
		function boxright(idx_r){
			setTimeout(function(e){
				$(idx_r).css({"opacity" : "1"});
				var setTime = $(idx_r).attr("data-wow-delay");
				$(".fadeInRight").css({"transform" : "translate(0)", "transition" : setTime})
			}, 500);
		}
		function boxup(idx_r){
			setTimeout(function(e){
				$(idx_r).css({"opacity" : "1"});
				var setTime = $(idx_r).attr("data-wow-delay");
				$(idx_r).css({"transform" : "translate(0,0)", "transition" : setTime});
			}, 1000);
		}




		function titleType(idx_r){
			if($(idx_r).css("opacity") == "0"){
				var setTime = $(idx_r).attr("data-wow-delay");
				setTimeout(function(e){
				$(idx_r).css({"opacity" : "1", "transition" : setTime});
				}, 100)
				setTimeout(function(e){
				$(idx_r).css({"transform" : "scale(1.1)"});
				$(idx_r).attr({"data-offset" : "49"});
				}, 200)
				setTimeout(function(e){
				$(idx_r).css({"transform" : "scale(0.9)"});
				}, 600)
				setTimeout(function(e){
				$(idx_r).css({"transform" : "scale(1.0)"});
				}, 1000)
			}
		}





		fontTypes();
		function fontTypes(){
			var element = $(".element").find("div");
			var i = 0;
			var e = 0;
			var val = "안녕하세요. \"YEOSU\" T-STORY입니다.";
			var val2 = "\"YEOSU\" T-STORY를 방문하신 여러분을 환영합니다.";
			var val3 = "\"YEOSU\" T-STORY는 미향여수의 아름다움을 전하고자 제작되었습니다.";
			var lv = 1;

			setTimeout(typetest, 100);		
			function typetest(){
				var eoo = $(".element");

				if(i < val.length && lv == 1){
					$(eoo).append(val.charAt(i));
					i++;
				setTimeout(typetest, 100);
				}else if(i >= val.length && lv == 1){
					e++;
					$(eoo).text(val.slice(0,-e));
					setTimeout(typetest, 50);
					if(e == val.length){
						lv = 2;
						i = 0;
						e = 0;
					}
				}else if(i < val2.length && lv == 2){
					$(eoo).append(val2.charAt(i));
					i++;
					setTimeout(typetest, 100);
				}else if(i >= val2.length && lv == 2){
					e++;
					$(eoo).text(val2.slice(0,-e));
					setTimeout(typetest, 50);
					if(e == val2.length){
						lv = 3;
						i = 0;
						e = 0;
					}
				}else if(i < val3.length && lv == 3){
					$(eoo).append(val3.charAt(i));
					i++;
					setTimeout(typetest, 100);
                    setInterval(function(){
                        
                    })
				}else if(i >= val3.length && lv == 3){
					e++;
					$(eoo).text(val3.slice(0,-e));
					setTimeout(typetest, 50);
					if(e == val3.length){
						lv = 1;
						i = 0;
						e = 0;
					}
				}
            }
		}
	},


	initTrigger : function(){
		$('body').on('dragover mouseover', '.gallery-back', function(e){
            e.preventDefault();
        })
        
        $('body').on('drop', '.gallery-back', function(e){
            e.preventDefault();
            var files = e.originalEvent.dataTransfer.files[0];
            
            file_upload(files);
        })
        
//        로그인 버튼 클릭
        $('body').on('click', '#login-modal .login-btn', function(e){
            var userid = $("#userid").val();
            var pw = $("#pw").val();
            
            var mb = JSON.parse(localStorage.getItem(userid));
            
            if(mb && mb.userid == userid && mb.pw == pw){
                alert('로그인이 완료되었습니다.');
                
                sessionStorage['userid'] = mb.userid;
                sessionStorage['username'] = mb.username;
                location.reload();
            } else {
                alert('아이디 또는 비밀번호가 일치하지 않습니다.');
                return false;
            }
        })
        
//        회원가입 버튼 클릭
        $('body').on('click', '#join-modal .join-btn', function(e){
            var userid = $("#j_userid").val();
            var pw = $("#j_pw").val();
            var pwc = $("#j_pwc").val();
            var username = $("#j_username").val();
            
            if(pw != pwc){
                alert('비밀번호가 일치하지 않습니다.');
                return false;
            }
            
            if(JSON.parse(localStorage.getItem(userid))){
                alert('이미 존재하는 아이디입니다.');
                return false;
            }
            
            var data = {
                userid : userid,
                pw : pw,
                username : username
            }
            
            localStorage.setItem(userid, JSON.stringify(data));
            
            alert('회원가입이 완료되었습니다.');
            location.reload();
        })
        
//        갤러리 이전 페이지
        $('body').on('click', '.img-paging .prev', function(e){
            var n_page = parseInt($('.gallery-area .img-paging').attr('data-nowpage'));
            var all = parseInt($('.img-paging .all').text());
            
            btn.off();
            if(n_page - 1 < 1){
                alert('이전 페이지는 없습니다.');
            } else {                
                $('.gallery-area .img-paging').attr('data-nowpage', n_page - 1);
            }
            
            galleryPageload("page");
            btn.on();
        })
        
//        갤러리 다음 페이지
        $('body').on('click', '.img-paging .next', function(e){
            var n_page = parseInt($('.gallery-area .img-paging').attr('data-nowpage'));
            var all = parseInt($('.img-paging .all').text());
            
            btn.off();
            if(n_page + 1 > all){
                alert('다음 페이지는 없습니다.');
            } else {                
                $('.gallery-area .img-paging').attr('data-nowpage', n_page + 1);
            }
            
            galleryPageload("page");
            btn.on();
        })
        
        $('body').on('click', '.gallery-remove', function(e){
            var idx = $(this).parents("li").index();
            var len = $("#portfolio .row > .col-md-3").length;
            
            $(this).parents("li").remove();
            $('.gallery-area .now-img img').eq(idx).remove();
            $('#portfolio .row > .wow').eq(idx).remove();
            
            var cnt = 0;
            
            $.each($('#portfolio .row > .wow'), function(k, v){
                if($(v).css('display') == 'none' && cnt == 0){
                    $(v).show();
                    
                    cnt++;
                }
            })
            
            if(len <= 8){
                var loop = 8 - len;
                
                for(var i = 0; i <= loop; i++){
                    $("#portfolio .row").append('<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn no-image" data-wow-offset="50" data-wow-delay="0.6s">\
                        <div class="portfolio-thumb">\
                                <h4>No Image</h4>\
                                <div class="portfolio-overlay">\
                                </div>\
                        </div>\
    				</div>');
                }
            }
            
            animation(0);
            idbBackup();
            galleryPageload("page");
        })
        
        $('body').on('click', '.logout-btn', function(e){
            sessionStorage.clear();
            alert('로그아웃이 완료되었습니다.');
            location.reload();
        })
	}
}

function file_upload(file){
    var reader = new FileReader();
    
    if(sessionStorage['userid'] == 'admin'){
        reader.readAsDataURL(file);
        reader.onload = function(e){
            var result = e.target.result;
            var image = new Image();

            image.src = result;
            image.onload = function(e){
                var len = $('.gallery-area .img-list li').length;
                var list = $("#portfolio .row > .wow");
                var cnt = 0;
                
                $.each(list, function(k, v){
                    var el = $(list).eq(len - k - 1);
                    
                    if($(el).css('display') != 'none' && cnt == 0 && len >= 8){
                        $(el).hide();
                        cnt++;
                    }
                })


                $('.gallery-area .img-list ul').prepend("<li draggable='true'><img src='"+image.src+"'><span class='gallery-remove'>x</span></li>");
                $('.gallery-area .now-img').prepend('<img src="'+image.src+'" style="display:none;">');
                
                $('#portfolio .row > .col-md-12').after('<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s">\
                        <div class="portfolio-thumb">\
                           <img src="'+image.src+'" class="img-responsive" alt="portfolio img 2">\
                                <div class="portfolio-overlay">\
                                    <h4>Project Eight</h4>\
                                    <p>시민과 함께하는 해양 관광 휴양도시, 아름다운 여수의 밤바다와 힐링이 있는 그 곳. 오늘 여수는 당신에게 주는 선물입니다.</p>\
                                    <a href="#" class="btn btn-default">DETAIL</a>\
                                </div>\
                        </div>\
                    </div>');
                
                $.each($('#portfolio .row > .no-image'), function(k, v){
                    var i = $('#portfolio .row > .no-image').length - k - 1;
                    
                    if(k == 0){
                        $('#portfolio .row > .no-image').eq(i).remove();
                    }
                });
                
                $.each($('.gallery-area .img-list > ul > li'), function(k, v){
                    if(k > 7){
                        $(v).hide();
                    }
                })
                
                animation(0);
                galleryPageload("");
                idbBackup();
            }
        }
    } else {
        alert('관리자만 파일을 업로드할 수 있습니다.');
        return false;
    }
}

//html 저장
function idbBackup(){
    var obj1 = {
        type : "ptf",
        html : $('#portfolio').html()
    }

    var obj2 = {
        type : "gallery",
        html : $('.gallery-area').html()
    }

    var req1 = db.transaction(['html'], 'readwrite').objectStore('html').put(obj1);

    var req2 = db.transaction(['html'], 'readwrite').objectStore('html').put(obj2);
}

function galleryPageload(type){
    var a_show = $('.gallery-area .img-list ul > li.anishow').index();
    
    if(type == ""){
        $('.gallery-area .img-paging').attr('data-nowpage', Math.ceil((a_show + 1) / 8));
    }
    
    
    var len = $('#portfolio .row > .wow:not(.no-image)').length;
    var n_page = $('.gallery-area .img-paging').attr('data-nowpage');
    var list = $('.gallery-area .img-list ul > li');
    
    $(list).hide();
    
    $.each(list, function(k, v){
        if((n_page - 1) * 8 <= k && n_page * 8 > k ){
            $(v).show();
        }
    })
    
    $('.gallery-area .img-paging .now').text(n_page);
    $('.gallery-area .img-paging .all').text(Math.ceil(len/8));
}

var btn = {
    on : function(){
        this.timer = setInterval(function(){
            slide('next');
        }, 3000);
    },
    off : function(){
        clearInterval(this.timer);
    }
 }

btn.on();

function ani_control(){
    var over_chk = false;
    var d_idx = 0;
    var k_num = "";
    
    $('.gallery-area .img-list ul li').eq(0).addClass('anishow');
    
    $('body').on('click', '.gallery-area .close-btn', function(e){
        $(this).parents(".gallery-area").hide();
    })

    $('body').on('click', '.gallery-area .img-list ul li img', function(e){
        var show_idx = $(this).parents("li").index();
        
        animation(show_idx);
        
        $('.gallery-area .img-list ul li').removeClass('anishow');
        $('.gallery-area .img-list ul li').eq(show_idx).addClass('anishow');
    })
    
    $('body').on('dragstart', '.gallery-area .img-list ul li', function(e){
        d_idx = $(this).index();
    })
    
    $('body').on('dragenter', '.gallery-area .left', function(e){
        over_chk = true;
    })
    
    $('body').on('dragend', '.gallery-area .img-list ul li', function(e){
        if(over_chk){
            animation(d_idx);    
            over_chk = false;
        }
    })
    
    $('body').on('keydown', function(e){
        var k_code = e.keyCode;
        
        if(k_code >= 48 && k_code <= 57){
            k_num = k_num+""+(k_code-48);
        }
        
        if(k_code == 46 && k_num != ""){
            var el = $('.gallery-area .img-list > ul > li:nth-child('+k_num+')');
            
            if(el){
                $(el).remove();
                $('.gallery-area .img-list ul li:nth-child('+k_num+')').remove();
            }
            
            k_num = "";
        }
    })
}

function slide(arrow){
    var idx = $('.gallery-area .img-list ul li.anishow').index();
    var len = $('.gallery-area .img-list ul li').length;
    
    switch(arrow){
        case 'next' :
            idx + 1 == len ? animation(0) : animation(idx + 1);
        break;
        case 'prev' :
            idx == 0 ? animation(len - 1) : animation(idx - 1);
        break;
    }
}

function animation(idx){
    btn.off();
    
    if(idx != $('.gallery-area ul li.anishow').eq(idx).index()){
        $('.gallery-area .img-list ul li').removeClass('anishow');
        $('.gallery-area .img-list ul li').eq(idx).addClass('anishow');
        $('.gallery-area .left .now-img img').fadeOut(500);
        $('.gallery-area .left .now-img img').eq(idx).fadeIn(500);
    }
    
    galleryPageload("");
    
//    setTimeout(function(){
//        var img_src = $('.gallery-area .img-list ul li').eq(idx).find('img').attr('src');
//        
//        $('.gallery-area .now-img').html('<img src="'+img_src+'" style="display:none;" >');
//        $('.gallery-area .now-img img').fadeIn(300);
//        
//    }, 300);
    btn.on();
}

$(function(){
	apps.init();
    
    $("body").on("click", ".portfolio-overlay", function(){
        var idx = $(this).parents(".wow").index() - 1;
        var n_chk = $(this).parents(".wow").hasClass('no-image');
        
        btn.off();
        
        $('.gallery-area .now-img img').remove();
        $('.gallery-area .img-list li').remove();
        
        var port = $('#portfolio img');
                    
        $.each(port, function(k, v){
            var img = $(v);
            var img_src = $(img).attr('src');
            
            $('.gallery-area .now-img').append("<img src='"+img_src+"' style='display:none;'>");
            if(k < 8){
                $('.gallery-area .img-list ul').append("<li draggable='true' ><img src='"+img_src+"'><span class='gallery-remove' >x</span></li>");
            } else {
                $('.gallery-area .img-list ul').append("<li draggable='true' style='display:none;' ><img src='"+img_src+"'><span class='gallery-remove' >x</span></li>");
            }
        })
        
        if(n_chk){
            $('.gallery-area .now-img img').eq(0).show();
            $('.gallery-area .img-list li').eq(0).addClass('anishow');
        } else {
            $('.gallery-area .now-img img').eq(idx).show();
            $('.gallery-area .img-list li').eq(idx).addClass('anishow');
        }
        
        $('.gallery-area').show();
        
        if(sessionStorage['userid'] != 'admin'){
            $('.gallery-area .gallery-remove').remove();
            
        }
        
        btn.on();
    });
    
    $('body').on('mouseover', 'header a', function(e){
        $(this).css({"color" : "#ff4e00"});
    })
    
    $('body').on('mouseout', 'header a', function(e){
        $(this).css({"color" : "#333"});
    })
    
    $('body').on('mouseover', '#home .btn', function(e){
        $(this).css({"border-color" : "transparent", "background-color" : "#28a7e9", "color" : "#fff"});
    })
    
    $('body').on('mouseout', '#home .btn', function(e){
        $(this).css({"border-color" : "#fff", "background-color" : "transparent", "color" : "#fff"});
    })
    
    $('body').on('mouseover', '#team .team-wrapper', function(e){
        $(this).css({"opacity" : "0.4", "bottom" : "4px"});
    })
    
    $('body').on('mouseout', '#team .team-wrapper', function(e){
        $(this).css({"bottom" : "0px", "opacity" : "1"});
    })
    
    $('body').on('mouseover', '#service .col-md-4:not(.active)', function(e){
        $(this).css({"background": "#505050"});
    })
    
    $('body').on('mouseout', '#service .col-md-4:not(.active)', function(e){
        $(this).css({"background" : "transparent"});
    })
    
    $('body').on('mouseover', '#portfolio .portfolio-thumb', function(e){
        var fd = $(this).find('.portfolio-overlay');
        
        $(fd).css({"cursor" : "pointer", "opacity" : "0.8"});
    })
    
    $('body').on('mouseout', '#portfolio .portfolio-thumb', function(e){
        var fd = $(this).find('.portfolio-overlay');
        
        $(fd).css({"opacity" : "0"});
    })
    
    $('body').on('mouseover', '.social-icon li a', function(e){
        $(this).css({"background" : "#28a7e9", "border-color" : "transparent", "color" : "#fff" });
    })
    
    $('body').on('mouseout', '.social-icon li a', function(e){    
        $(this).css({"background" : "transparent", "border-color" : "#fff", "color" : "#fff" });
    })
    
    $('body').on('click', '#contact form input[type="submit"]', function(e){
        e.preventDefault();
        
        var name = $('#fullname').val();
        var email = $('#email').val();
        var msg = $('#message').val();
        
        if(name == '' || email == '' || msg == ''){
            alert('누락 항목이 존재합니다.');
            return false;
        }
        
        $.each($("#contact form input"), function(k, v){
            if($(v).attr('type') != 'submit'){
                $(v).val('');
            }
        })
        
        $('#contact form textarea').val('');
        
        alert('메시지가 전송되었습니다.');
        
        $('body, html').animate({scrollTop : $(document).height()}, 500);
        
        setTimeout(function(){
            $('body, html').animate({scrollTop : 0}, 500);
        }, 500);
    })
    
    
    $('body').on('mouseover', '.fa', function(e){
        $(this).css({"background-color" : "#28a7e9"});
    })
    
    $('body').on('mouseout', '.fa', function(e){
        $(this).css({"background-color" : "transparent"});
    })
    
    $('body').on('mouseover', 'address i.fa', function(e){
        $(this).css({"background-color" : "transparent"});
    })
    
    $('body').on('mouseover', '#about .row > .col-md-4 .fa', function(e){
        console.log(2);
        
        $(this).stop();
        
        $(this).animate({"margin-top" : "90px"}, 500);
        
        $(this).animate({"margin-top" : "0"}, 500);
    })
    
//    $('body').on('mouseout', '#about .row > .col-md-4', function(e){
//        var fd = $(this).find('.fa');
//        
//        $(fd).animate({"margin-top" : "90px"}, 2000);
//    })
})


function div_replay()
 {
  document.readform.left_scroll_top.value=document.all['LEFT_SCROLL'].scrollTop;
  document.readform.right_scroll_top.value=document.all['RIGHT_SCROLL'].scrollTop;  
 } 
 
 //SCROLL Bar Reload
 function div_replay_scroll()
 {
  document.all['LEFT_SCROLL'].scrollTop = document.readform.left_scroll_top.value;
  document.all['RIGHT_SCROLL'].scrollTop = document.readform.right_scroll_top.value;
 }

$(function(){
    $("textarea").dblclick(function(){ 
        var el = $(this);
        var text = $(el).val();
        
        $(el).css({"height" : "auto"});
        
        if(text == ""){
            $(el).attr('rows', "5");
        } else {
            var txt_r = text.split("\n");
            
            $(el).attr('rows', txt_r.length);
        }
    });
    
    $('body').on('keyup', 'textarea', function(e){
        var el = $(this);
        var text = $(this).val();
        var txt_r = text.split("\n");
        
        $.each(txt_r, function(k, v){
//            var r_plus = 0;
//            var len = 0;
//            
//            console.log(v.length);
//            
//            for (var i = 0; i < v.length; i++) {
//                if (escape(v.charAt(i)).length == 6) {
//                    len++;
//                }
//                len++;
//            }
            var str = v;

            var charLength = 0;

            var ch1 = "";



            for(var i = 0; i < str.length; i++) {

                ch1 = str.charAt(i);



                if(escape(ch1).length > 4) {		

                    charLength += 2;

                } else {

                    charLength += 1;

                }

            }
            
            alert(str + " 문자열 총 길이는 :" + charLength);
        })



        
        
    })
});