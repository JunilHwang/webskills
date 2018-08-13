// common.js
var information = {}
$.ajax({
	type:'GET',
	url:"data/information.json",
	success:function(data){
		information = data.information; 
	}
})

var
	storageMember = localStorage.getItem('member'),
	storageNowMember = sessionStorage.getItem('nowMember'),
	storageComment = localStorage.getItem('comment'),
	storageKeies = localStorage.getItem('keies');
var
	member = storageMember ? JSON.parse(storageMember) : {},
	nowMember = storageNowMember ? JSON.parse(storageNowMember) : null,
	comment = storageComment ? JSON.parse(storageComment) : {},
	keies = storageKeies ? JSON.parse(storageKeies) : [],
	info_idx = null;

$(loadFun)
.on("submit",".joinFrm",joinSubmit)
.on("submit",".loginFrm",loginSubmit)
.on("click",".logout_btn",logout)
.on("click",".categories li",categoryList)
.on("click",".more_view",moreView)
.on("submit",".commentFrm",commentSubmit)
.on("click",".commentDelete",commentDelete)
.on("submit",".searchFrm",searchSubmit)
.on("focus",".searchFrm input",searchKeies)
.on("blur",".searchFrm input",searchKeiesHidden)

function loadFun(){

	if(nowMember == null){
		$('body.login_wrap').removeClass("login_wrap admin_wrap").addClass('logout_wrap');
	} else {
		$("body.logout_wrap").removeClass("logout_wrap").addClass("login_wrap");
		if(nowMember.id == 'admin') $('body').addClass('admin_wrap');
	}

	if(!member.admin){
		member['admin'] = {
			id:'admin',
			pw:'1234',
			name:'관리자'
		}
		localStorage.setItem('member',JSON.stringify(member));
	}

	// login
	$(".login_btn").click(function(e){
		$(".bg").animate({"height" : "100vh", opacity : 1}, 500, function(e){
			$(".login").show();
		});

		$(".bg span").click(function(e){
			$(".login").hide(function(){
				$(".bg").animate({"height" : 0, opacity : 0}, 500);
			});
		});
	});

	// join
	$(".join_btn").click(function(e){
		$(".bg").animate({"height" : "100vh", opacity : 1}, 500, function(e){
			$(".join").show();
		});

		$(".bg span").click(function(e){
			$(".join").hide(function(){
				$(".bg").animate({"height" : 0, opacity : 0}, 500);
			});
		});
	});

	// modi_view
	$(".modi_view").click(function(e){
		$(".bg").animate({"height" : "100vh", opacity : 1}, 300, function(e){
			$(".modi").show();
		});

		$(".bg span").click(function(e){
			$(".more").hide(function(){
				$(".bg").animate({"height" : 0, opacity : 0}, 300);
			});
		});
	});

	showInformation();

}

function showInformation(option){
	var category = 'all';
	var searchKey = null;
	if(option && option.category) category = option.category;
	if(option && option.searchKey) searchKey = option.searchKey;
	var target = $(".newsfeed>.row");
	var template =
		'<div class="col-md-12 feeds box">\
			<div class="row">\
				<div class="feed_image"><img src="./images/{{image}}" alt="{{name}}"/></div>\
				<div class="feed_con">\
					<h1>{{name}}</h1>\
					<p>{{info}}</p>\
					<h3>업데이트 날짜 : {{date}}</h3>\
					<h3>카테고리 : {{categories}}</h3>\
					<div><button class="more_view" data-idx="{{idx}}">더보기</button></div>\
				</div>\
			</div>\
		</div>';
	$(".feeds",target).remove();
	for(var i=0,len=information.length;i<len;i++){
		var obj = information[i];
		if(category != 'all' && obj.categories != category) continue;
		if(searchKey != null && obj.name.indexOf(searchKey) == -1) continue;
		var text = template
					.replace(/{{idx}}/gi,obj.idx)
					.replace(/{{image}}/gi,obj.image)
					.replace(/{{name}}/gi,obj.name)
					.replace(/{{info}}/gi,obj.info)
					.replace(/{{categories}}/gi,obj.categories)
					.replace(/{{date}}/gi,obj.date ? obj.date : "0000-00-00");
		target.append(text);
	}
}

function joinSubmit(){
	var reg;
	if(this.pw_re.value != this.pw.value){
		alert('입력된 비밀번호가 서로 다릅니다. 다시 입력해주세요.');
		this.pw_re.focus();
		return false;
	}
	reg = new RegExp(/[가-힣]+/);
	if(reg.test(this.name.value) == false){
		alert('이름은 한글로 입력해주세요.');
		this.name.focus();
		return false;
	}
	reg = new RegExp(/[0-9]+/);
	if(reg.test(this.tel.value) == false){
		alert('전화번호는 숫자만 사용 가능하니다.')
		this.tel.focus();
		return false;
	}
	if(member[this.id.value]){
		alert('중복된 아이디가 있습니다. 다시 입력해주세요.');
		return false;
	}
	member[this.id.value] = {
		id:this.id.value,
		pw:this.pw.value,
		name:this.name.value,
		tel:this.tel.value,
	}
	localStorage.setItem('member',JSON.stringify(member));
	alert('회원가입이 완료되었습니다.');
	this.reset();
	$(".join").hide(function(){
		$(".bg").animate({"height" : 0, opacity : 0}, 500);
	});
	return false;
}

function loginSubmit(){
	var chk = false;
	if(member[this.id.value] && member[this.id.value].pw == this.pw.value){
		chk = true;
	}
	if(!chk){
		alert('아이디 또는 비밀번호가 일치하지 않습니다.');
		this.pw.focus();
		return false;
	}
	alert('로그인이 완료되었습니다.');
	nowMember = member[this.id.value];
	this.reset();
	$(".login").hide(function(){
		$(".bg").animate({"height" : 0, opacity : 0}, 500);
	});
	$("body.logout_wrap").removeClass("logout_wrap").addClass("login_wrap");
	if(nowMember.id == 'admin') $('body').addClass("admin_wrap");
	sessionStorage.setItem('nowMember',JSON.stringify(nowMember));
	return false;
}

function logout(){
	nowMember = null;
	sessionStorage.clear();
	$('body.login_wrap').removeClass("login_wrap").addClass('logout_wrap');
	alert('로그아웃 되었습니다.');
}

function categoryList(){
	var category = $(this).data("text");
	showInformation({category:category});
}

function moreView(){
	var idx = info_idx = $(this).data("idx");
	var info = (function(){
		var obj;
		for(var i=0,len=information.length;i<len;i++){
			obj = information[i];
			if(obj.idx == idx) break;
		}
		return obj;
	}())
	var target = $(".more.view");
	commentList(idx);
	$(".info_img",target).attr("src","images/"+info.image);
	$(".info_name",target).html(info.name);
	$(".info_info",target).html(info.info);
	$(".info_categories",target).html(info.categories);
	$(".bg").animate({"height" : "100vh", opacity : 1}, 300, function(e){
		$(".view").show();
	});

	$(".bg span").click(function(e){
		$(".more").hide(function(){
			$(".bg").animate({"height" : 0, opacity : 0}, 300);
		});
		info_idx = null;
	});
}

function commentSubmit(){
	var last = comment[comment.length - 1];
	var commentIdx = last ? parseInt(last.idx)+1 : 1;
	var date = new Date();
	var commentInfo = {		
		parent:commentIdx,
		id:nowMember.id,
		name:nowMember.name,
		content:this.content.value,
		date:date.getTime()
	}
	if(!comment[commentIdx]) comment[commentIdx] = [];
	comment[commentIdx].push(commentInfo);
	localStorage.setItem('comment',JSON.stringify(comment));
	this.reset();
	commentList(commentIdx);
	return false;
}

function commentList(idx){
	$(".comment_list").empty();
	if(!comment[idx] && comment[idx].length) return;
	var template = 
		'<div>'+
			'<p>{{content}}</p>'+
			'<p class="stateLogin hidden"><a href="#" class="commentDelete" data-idx="{{idx}}" data-parent="{{parent}}">삭제</a></p>'+
			'<p>{{date}}</p>'+
			'<p>{{name}}</p>'+
		'</div>';
	var fullText = "";
	var commentLen = comment[idx].length - 1;
	for(var i=commentLen; i>=0; i--){
		var obj = comment[idx][i];
		if(!obj) continue;
		var fullDate = getDateFormat(obj.date);
		var text = template
					.replace("{{name}}",obj.name)
					.replace("{{content}}",obj.content)
					.replace("{{idx}}",i)
					.replace("{{parent}}",idx)
					.replace("{{date}}",fullDate)
		if(nowMember && obj.id == nowMember.id){
			text = text.replace(" hidden","");
		}
		fullText += text;
	}
	$(".comment_list").html(fullText);
}

function commentDelete(){
	var parent = $(this).data("parent");
	var num = $(this).data("idx");
	delete comment[parent][num];
	localStorage.setItem('comment',JSON.stringify(comment));
	alert('삭제되었습니다.');
	commentList(parent);
}

function getDateFormat(time){
	var date = new Date(time);
	var year = date.getFullYear();
	var month = date.getMonth()+1;
	var day = date.getDate();
	if(month < 10) month = "0"+month;
	if(day < 10) day = "0"+day;
	return year+"-"+month+"-"+day;
}

function searchSubmit(){
	if(!this.key.value.length){
		alert('검색어를 입력해주세요');
		this.key.focus();
		return false;
	}
	if(keies.indexOf(this.key.value) == -1) keies.push(this.key.value);
	localStorage.setItem('keies',JSON.stringify(keies));
	showInformation({searchKey:this.key.value});
	searchKeies();
	return false;
}

function searchKeies(){
	$(".search-form input").autocomplete({
		source:keies
	});
}