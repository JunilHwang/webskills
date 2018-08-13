class Path {
	
	// variable setting
	static init () {
		Path.lbl    = ['오동도','여수밤바다','향일암','금오도 비렁길','여수세계박람회장','전남관','해상케이블카','이순신대교','거문도/백도','영취산 진달래']
		Path.normal = [
			[0	,	11	,	37	,	20	,	77	,	54	,	10	,	95	,	27	,	57	],	// 오동도
			[8	,	0	,	27	,	11	,	98	,	10	,	62	,	67	,	43	,	70	],	// 여수밤바다
			[87	,	9	,	0	,	95	,	87	,	78	,	16	,	33	,	35	,	40	],	// 향일암
			[44	,	34	,	78	,	0	,	29	,	19	,	11	,	48	,	74	,	86	],	// 금오도 비렁길
			[64	,	39	,	70	,	36	,	0	,	87	,	98	,	98	,	24	,	89	],	// 여수세계박람회장
			[50	,	86	,	68	,	17	,	12	,	0	,	19	,	61	,	26	,	97	],	// 전남관
			[69	,	87	,	40	,	44	,	24	,	63	,	0	,	57	,	10	,	35	],	// 해상케이블카
			[19	,	2	,	30	,	27	,	23	,	76	,	54	,	0	,	79	,	71	],	// 이순신대교
			[64	,	95	,	12	,	39	,	21	,	99	,	66	,	27	,	0	,	11	],	// 거문도/백도
			[51	,	42	,	3	,	92	,	44	,	98	,	60	,	7	,	7	,	0	], 	// 영취산 진달래
		]
		Path.createTimeTable()
		Path.createPathTemplate()
		/* example
			0 => 1 : 11	 |	0 => 1 => 2 : 11 + 27 	= 38
			0 => 2 : 37	 |	0 => 2 => 1 : 37 + 38	= 65
			1 => 0 : 8	 |	1 => 2 => 0 : 27 + 87	= 114
			1 => 2 : 27	 |	1 => 0 => 2 : 9 + 37	= 46
			2 => 0 : 87	 |	2 => 0 => 1 : 87 + 11	= 98
			2 => 1 : 34	 |	2 => 1 => 0 : 34 + 11	= 45
			shortest : 0 => 1 => 2 : 38
		*/
	}

	// craete template
	static createTimeTable () {
		const label    = Path.lbl
		const arr      = Path.normal
		const styletxt = `
			<style>
				.timeTableView{font-size:11px}
				.timeTableView table{width:100%}
				.timeTableView td,
				.timeTableView th{width:9%;border:1px solid #ddd;}
			</style>
		`
		let   text     = '<table><thead><tr><th>-</th>'
		for (let i = 0; i < 10; i++)
			text += `<th>${label[i]}</th>`
		text += '</tr></thead><tbody>'
		for (let i = 0; i < 10; i++) {
			text += `<tr><th>${label[i]}</th>`
			for (let j = 0; j < 10; j++)
				text += `<td>${arr[i][j]} 분</td>`
			text += '</tr>'
		}
		text += '</tbody></table>'
		Path.timeTable = `<div class="timeTableView">${text}</div>`
		$('head').append(styletxt)
	}

	// createPathTemplate
	static createPathTemplate () {
		Path.template = `
			<div class="path-wrap">
				<div class="line">
					<span class="lbl">최단 경로 :</span>
					<p class="desc">{{path}}</p>
				</div>
				<div class="line">
					<span class="lbl">소요 시간 :</span>
					<p class="desc">{{cost}} 분</p>
				</div>
			</div>
		`
	}

	// 분기와 한정 : 전체 경로 탐색
	static shortPathTree (start, arr, step, p) {
		delete arr[start]
		if (p.length === arr.length) {
			Path.pathList.push(p)
			return
		}
		arr.forEach((val, idx) => {
			let new_p = p.slice()
			new_p.push(idx)
			Path.shortPathTree(idx, arr.slice(), step+1, new_p)
		})
	}

	// 배열 재 정의
	static reDefine (arr, len) {
		let newArr = []
		for (let i = 0; i < len; i++) {
			const parent = Path.normal[arr[i]]
			let child = []
			for (let j = 0; j < len; j++)
				child.push(parent[arr[j]])
			newArr.push(child)
		}
		return newArr
	}

	// 최단 경로 구하기
	static allShortPath (arr) {
		Path.pathList = []
		let len      = arr.length
		let selected = Path.reDefine(arr, len)
		let min      = [-1, 10000]
		for (let i = 0; i < len; i++)
			Path.shortPathTree(i, selected.slice(), 1, [i])
		const list = Path.pathList;
		for (let i = 0, pathLen = list.length; i < pathLen; i++) {
			let costSum = 0
			let costList = []
			for (let j = 0; j < len - 1; j++) {
				const cost = selected[list[i][j]][list[i][j+1]]
				costSum += cost
				costList.push(cost)
			}
			if(min[1] > costSum) min = [i, costSum, costList]
		}
		return [list[min[0]], min[1], min[2]]
	}

	// Shortest
	static Shortest () {
		let arr = []
		let label = []
		this.path.forEach(ele=>{
			if (ele.checked) {
				arr.push(ele.value)
				label.push(Path.lbl[ele.value])
			}
		})
		if (arr.length < 2) {
			alert('2개 이상의 관광지를 선택해주세요')
			return false
		}
		const info = Path.allShortPath(arr)
		const pathString = (function () {
			let str = ""
			info[0].forEach((ele,idx) => {
				if(idx > 0) {
					str += `<i class="fas fa-long-arrow-alt-right"></i> <span class="cost">${info[2][idx-1]} 분</span>`
				}
				str += label[ele]
			})
			return str
		}())
		const template = Path.template
							.replace("{{path}}", pathString)
							.replace("{{cost}}", info[1])
		$('.shortest-path').html(template)
		return false
	}

	// timeTable
	static timeTableView () {
		Layer.realOpen(Path.timeTable)
		return false
	}
}