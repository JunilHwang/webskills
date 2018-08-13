// initialize
function init () {

}

// modal
const Layer = (new function () {
	const template = `
	<div class="layer">
	    <span class="middle"></span><div class="layer_box">
	    	<a href="#" class="layer_close">X</a>
	    	{{content}}
	    </div>
	</div>
	`
	let layerHistory = [], before_url

	function open () {
		const open_url = this.href || $(this).data('url')
		real_open(open_url)
		return false
	}

	function real_open (open_url) {
		if ($('.layer').length) {
			$('.layer').remove()
			before_url = layerHistory.pop()
		}
		layerHistory.push(open_url)
		$.get(open_url)
			.done(content => {
				$(template.replace('{{content}}', content)).appendTo('body')
				$('.layer').stop().fadeIn(300)
				$('.layer [autofocus]').focus()
			})
	}

	function close () {
		$('.layer').stop().fadeOut(300, function () {
			$(this).remove()
		})
		return false
	}

	function back () {
		real_open(before_url)
		return false
	}

	return {
		open,
		close,
		back
	}
}())

// key event
function keyEvent (e) {
	const key = e.keyCode
	switch (key) {
		case 27 :
			Layer.close()
		break;
	}
}

// course select
function courseSelect () {
	let stackValue = [],
		stackText = []

	function update (obj) {
		let val = obj.form.check_list.value
		let lbl = obj.form.check_list_string.value
		if (val.length > 0 && stackValue.length == 0 ) {
			stackValue = val.split(',')
			stackText  = lbl.split(',')
		}
	}

	function set () {
		const targetText = $('.course-selected')[0]
		const targetInput = $('#check-list')[0]
		targetText.innerHTML = stackText.join(' <i class="material-icons">navigate_next</i> ');
		targetInput.value = stackValue.join(",");
	}

	function get (obj) {
		const val = obj.value
		if (obj.checked) {
			stackValue.push(val)
			stackText.push(obj.nextElementSibling.innerHTML)
		} else {
			const idx = stackValue.indexOf(val)
			stackValue.splice(idx,1)
			stackText.splice(idx,1)
		}
	}

	return function () {
		update(this)
		get(this)
		set()
	}
}

// event register
$(init)
	.on('click', '.layerOpener', Layer.open)
	.on('click', '.layer_close', Layer.close)
	.on('click', '.layer_before', Layer.back)
	.on('change', '.check-list input', courseSelect())
	.on('keyup', keyEvent)