// Layer Class
class Layer {

	static init () {
		const styleText = `
			<style>
				.layer{display:none;position:absolute;left:0;top:0;bottom:0;right:0;background:rgba(0,0,0,0.5);text-align:center;overflow:auto;text-align:center;}
				.layer .middle{display:inline-block;vertical-align:middle;width:0;height:100%}
				.layer .box{display:inline-block;vertical-align:middle;text-align:left;margin:10px;width:100;position:relative;background:#fff;width:80%;padding:25px;}
				.layer .close{position:absolute;right:0;top:0;display:block;padding:3px 6px;background:#aaa;color:#fff;text-decoration:none;transition:0.3s;}
				.layer .close:hover{background:#09F}
				.layer .img_wrap{float:right;overflow:hidden;max-width:50%;padding-left:30px;}
				.layer .name{font-size:25px;display:block;padding-bottom:10px;}
				.layer .real-content{line-height:160%;}
			</style>`

		Layer.layout = `
			<div class="layer">
				<span class="middle"></span><div class="box">
					<a href="#" class="close">X</a>
					{{content}}
				</div>
			</div>
		`
		$(styleText).appendTo('head')
	}

	static open () {
		const html = this.innerHTML
		Layer.realOpen(html)
	}

	static realOpen (content) {
		const html = Layer.layout.replace('{{content}}', content)
		$('.layer').remove()
		$(html).appendTo('.wrap')
		$('.layer').stop().fadeIn(300)
	}

	static close () {
		$('.layer').stop().fadeOut(300, function () {
			this.remove()
		})
	}

	static keyClose (e) {
		if (e.keyCode == 27) Layer.close()
	}
}