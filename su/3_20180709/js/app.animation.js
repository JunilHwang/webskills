// animation set
class Animation {
	constructor (option) {
		/* set variable */
		this.delay     = 30
		this.lastTimer = 0
		this.obj       = option.obj
		this.reverse   = option.reverse || false
		this.callback  = option.callback || function () {}

		/* start play */
		this.play()
	}

	find (ele) { return this.obj.find(ele) }

	play () {
		this.clear()
		let timer = 0
		const i = this // instance
		const seq = i.reverse ? i.find('.target-reverse') : i.find('.animation')
		const len = seq.length
		seq.each(function (num) {
			const target = $(this)
			Animation.timeObj.push(setTimeout(() => {
				if(i.reverse === true){
					const idx = len - num - 1
					seq.eq(idx).addClass("animationBefore type2").removeClass('target-reverse')
				} else {
					target.removeClass("animationBefore type2").addClass('target-reverse')
				}
			}, timer))
			timer += i.delay + (target.data('delay') ? parseInt(target.data('delay')) : 0)
		})
		i.lastTimer = timer
		setTimeout(i.callback, i.lastTimer)
	}

	clear () {
		Animation.timeObj.forEach(element => { clearTimeout(element) })
		Animation.timeObj = []
	}

	static init () {
		$('.childAnimation>*:not(.childAnimation)').each(function () {
			const _this = $(this)
			const parent = _this.parent()
			_this.addClass("animation")
			if (parent.data('type')) {
				_this.addClass(parent.data('type'))
			}
		})
		$('.animation').addClass('animationBefore')
		Animation.timeObj = []
		Animation.styleSet()
	}

	static styleSet () {
		const styleText = `
			<style>
				.animation{opacity:1;transform:inherit;transition:1s}
				.animation.animationBefore{opacity:0;transform:scale(0);transition:0s}
				.animation.animationBefore.top2btm{transform:translateY(-100px)}
				.animation.animationBefore.btm2top{transform:translateY(100px)}
				.animation.animationBefore.left2right{transform:translateX(-100px)}
				.animation.animationBefore.right2left{transform:translateX(100px)}
				.animation.animationBefore.big2small{transform:scale(2, 2)}
				.animation.animationBefore.type2{transition:1s}
			</style>`
		$(styleText).appendTo('head')
	}
}