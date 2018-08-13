function loadFunction(){
	$("head").append('\
		<style>\
			.animation{opacity:inherit;transition:0.3s;transform:inherit;}\
			.animation.animationBefore{opacity:0;transform:translateX(100px);transition:inherit}\
			.item:hover{transform:scale(1.2,1.2) rotate(5deg);transition:.3s;z-index:10;}\
			.layer{position:fixed;left:0;right:0;bottom:0;top:0;background:rgba(0,0,0,.5);z-index:100;text-align:center;display:flex;justify-content:center;align-items:center;transition:.3s;}\
			.layer .box{background:#fff;position:relative;max-width:calc(100% - 10px);max-height:calc(100% - 10px);animation:layerOpen 0.5s;padding:10px 200px;}\
			.layer.layerCloseActive{opacity:0;}\
			.layer.layerCloseActive .box{animation:layerClose 0.5s;opacity:0;}\
			.layer img{max-width:100%;max-height:calc(90vh - 40px);}\
			.layer .btn{font-size:13px;background:#09f;color:#fff;border-radius:3px;border-bottom:1px solid #004c7e;text-decoration:none;display:inline-block;text-align:center;}\
			.layer .arrow{position:absolute;top:calc(50% - 20px)}\
			.layer .arrow.left{left:10px;}\
			.layer .arrow.right{right:10px;}\
			.layer .layer_close{position:absolute;right:10px;}\
			.layer .layer_close.top{top:10px;}\
			.layer .layer_close.bottom{bottom:10px;}\
			.layer p{padding:0;margin:10px;color:#666;}\
			#fh5co-header{position:relative;z-index:10;}\
			#fh5co-board{position:relative;}\
			.item{width:calc(25% - 20px);position:absolute;}\
			#header .menu_bg{position:fixed;left:0;right:0;top:0;bottom:0;z-index:100;background:rgba(0,0,0,.5);cursor:pointer;}\
			@keyframes layerOpen{\
				from {opacity:0;transform:translateY(-100px)}\
				to {opacity:inherit;transform:inherit;}\
			}\
			@keyframes layerClose{\
				from {opacity:inherit;transform:inherit;}\
				to {opacity:0;transform:translateY(-100px)}\
			}\
			#fh5co-offcanvass.active{transform:inherit;}\
		</style>\
	')
	// $(".gnb ul").append('\
	// 	<li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>\
	// 	<li><a href="#"><i class="fab fa-instagram"></i> Instargram</a></li>\
	// 	<li><a href="#"><i class="fab fa-google-plus-g"></i> Google+</a></li>\
	// ')
	$(".animate-box").addClass("animation animationBefore")
	itemSet();
}

function itemSet(){
	var line = 0;
	var beforeOffset = [50,50,50,50];
	var width = $("#fh5co-board").width()/4;
	var left = [0,width,width*2,width*3];
	$(".item").each(function(idx){
		var pos = idx % 4;
		h = beforeOffset[pos]+$(this).height()+10;
		$(this).css({
			left:left[pos]+"px",
			top:beforeOffset[pos]+"px"
		})
		beforeOffset[pos] = h;
	})
	var max = beforeOffset[0];
	for(var i=1;i<4;i++){
		if(beforeOffset[i] > max)
			max = beforeOffset[i];
	}
	$("#fh5co-board").height(max);
	scrollAnimation()
}

function scrollAnimation(){
	var st = $(window).scrollTop();
	var sh = $(window).height();
	var sb = st+sh;
	$(".animate-box").each(function(index){
		var ot = $(this).offset().top;
		var h = $(this).outerHeight();
		var ob = ot+h;
		if(st <= ot && sb >= ob){
			if($(this).hasClass('animationBefore')) $(this).removeClass("animationBefore")
		} else {
			if(!$(this).hasClass('animationBefore')) $(this).addClass("animationBefore")
		}
	})
	hideMenu();
}

var layerIndex = 0;
function layerOpen(){
	if($(".layer").length) $(".layer").remove();
	layerIndex = $(this).index();
	var index = layerIndex+1;
	var src = "images/img_"+index+".jpg";
	var total = $(".item").length;
	var desc = $(".fh5co-desc",this).html();
	var layerTag ='\
			<div class="layer">\
				<div class="box">\
					<a href="#" class="arrow btn left">뒤로 가기</a>\
					<a href="#" class="arrow btn right">앞으로 가기</a>\
					<a href="#" class="layer_close btn top">닫기</a>\
					<a href="#" class="layer_close btn bottom">닫기</a>\
					<img src="'+src+'" alt="'+index+'" />\
					<p>'+desc+'</p>\
					<p>현재 사진 번호 : '+index+' / 전체 사진 수 : '+total+'</p>\
				</div>\
			</div>';
	$('body').append(layerTag);
	//setTimeout(layerImageSet,100);
	return false;
}

function layerClose(){
	$(".layer").addClass("layerCloseActive");
	setTimeout(function(){
		$(".layer").remove()
	},300)
}

function changeLayer(){
	var total = $(".item").length;
	if($(this).hasClass("left")){
		if(--layerIndex < 0) layerIndex = total-1;
	} else {
		if(++layerIndex >= total) layerIndex = 0;
	}
	$(".item").eq(layerIndex).click();
}

function showMenu(){
	$("#fh5co-offcanvass").addClass("active")
}

function hideMenu(){
	$("#fh5co-offcanvass").removeClass("active")
}

function resizeImage(){
	itemSet();
}

$(loadFunction)
.on("click",".item",layerOpen)
.on("click",".layer_close",layerClose)
.on("click",".layer .arrow",changeLayer)
.on("click",".fh5co-menu-btn",showMenu)
.on("click",".js-fh5co-offcanvass-close, #fh5co-header, #fh5co-main, #fh5co-footer",hideMenu)
.on("click","a[href='#']",function(){ return false; })

$(window)
.on("resize",resizeImage)
.on("scroll",scrollAnimation)