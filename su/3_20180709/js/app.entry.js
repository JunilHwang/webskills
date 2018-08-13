// slide animation
function slide () {

	let lock = true

	return function () {
		if (!lock) return
		lock = false
		const flow = $(event.target).hasClass('right')
		const obj = $(".slide-wrap>div")
		const next = () => {
			lock = true
			if (!flow) return
			obj.find('article:first-child').appendTo(obj)
			obj.css('marginLeft', '0')
		}
		const prev = () => {
			if (flow) return
			obj.find('article:last-child').prependTo(obj)
			obj.css('marginLeft', '-20%')
		}
		prev()
		obj.stop().animate({
			marginLeft: flow ? "-20%" : "0"
		}, 500, next)
	}
}

// tab menu
function tabView () {

	const styleText = `
		<style>
			@keyframes tabView {
				from {opacity:0;transform:translateY(50px)}
				to {opacity:1;transform:inherit}
			}
			.tab-content article.active{animation:0.5s tabView}
		</style>`

	$(styleText).appendTo('head')

	return function () {
		if($(this).hasClass('active')) return
		const _this = $(this)
		const idx = _this.index()
		_this.parent().find('li a.active').removeClass('active')
		_this.find('a').addClass('active')
		$('.tab-content article.active').removeClass('active')
		$('.tab-content article').eq(idx).addClass('active')		
	}
}

// application init
function init () {
	Animation.init()
	Navigation.init()
	Layer.init()
	Path.init()
}

// event register
$(init)
	.on('click', 'a[href="#"]', function (e) { e.preventDefault() })
	.on('click', '.toMain', Navigation.goToMain)
	.on('click', '.site-menu li', Navigation.goToPage)
	.on('click', '.arrow a', Navigation.goToArrow)
	.on('click', '.sub02 article, .sub03 article', Layer.open)
	.on('click', '.sub02 .slide-arrow', slide())
	.on('click', '.layer .close', Layer.close)
	.on('click', '.tab li', tabView())
	.on('keyup', Layer.keyClose)
	.on('click', '.time-table', Path.timeTableView)
	.on('submit', '.short-path', Path.Shortest)