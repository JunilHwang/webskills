class Path {
	
	// variable setting
	static init () {
		Path.lbl    = ['오동도','여수밤바다','향일암','금오도 비렁길','여수세계박람회장','전남관','해상케이블카','이순신대교','거문도/백도','영취산 진달래']
		Path.normal = [
			[0	,	11	,	37	,	20	,	77	,	54	,	10	,	95	,	27	,	57	],	// 오동도
			[8	,	0	  ,	27	,	11	,	98	,	10	,	62	,	67	,	43	,	70	],	// 여수밤바다
			[87	,	9	  ,	0	  ,	95	,	87	,	78	,	16	,	33	,	35	,	40	],	// 향일암
			[44	,	34	,	78	,	0	  ,	29	,	19	,	11	,	48	,	74	,	86	],	// 금오도 비렁길
			[64	,	39	,	70	,	36	,	0	  ,	87	,	98	,	98	,	24	,	89	],	// 여수세계박람회장
			[50	,	86	,	68	,	17	,	12	,	0	  ,	19	,	61	,	26	,	97	],	// 전남관
			[69	,	87	,	40	,	44	,	24	,	63	,	0	  ,	57	,	10	,	35	],	// 해상케이블카
			[19	,	2	  ,	30	,	27	,	23	,	76	,	54	,	0	  ,	79	,	71	],	// 이순신대교
			[64	,	95	,	12	,	39	,	21	,	99	,	66	,	27	,	0	  ,	11	],	// 거문도/백도
			[51	,	42	,	3	  ,	92	,	44	,	98	,	60	,	7	  ,	7	  ,	0	  ], 	// 영취산 진달래
		]
		Path.createTimeTable()
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
		Path.timeTable = `
			<div class="timeTableView">
				<table>
					<thead>
						<tr>
							<th>-</th>
							${label.map(v => `<th>${v}</th>`).join('')}
						</tr>
					</thead>
					<tbody>
						${label.map((v, k) => `
							<tr>
								<th>${v}</th>
								${arr[k].map(t => `<td>${t} 분</td>`).join('')}
							</tr>
						`).join('')}
					</tbody>
				</table>
			</div>
		`
		$('head').append(styletxt)
	}

	// 최단 경로 구하기
	static allShortPath (arr) {
		const len = arr.length
		let min = Infinity, path = []

		// 분기와 한정 : 전체 경로 탐색
		const f = (p, t) => {
			if (t > min) return
			if (p.length === arr.length) {
				if (t < min) { min = t, path = p }
				return
			}
			arr.forEach(v => {
				if (p.indexOf(v) === -1) {
					const add = p[0] === undefined ? 0 : Path.normal[p[p.length - 1]][v]
					f([...p, v], t + ~~add)
				}
			})
		}
		f([], 0)
		const cost = path.map((v, k) =>  k > 0 ? Path.normal[path[k - 1]][v] : 0)
		return [min, path, cost]
	}

	// Shortest
	static Shortest () {
		const arr = Array.from(this.path).filter(v => v.checked)
		if (arr.length < 2) {
			alert('2개 이상의 관광지를 선택해주세요')
			return false
		}
		const [min, path, cost] = Path.allShortPath(arr.map(v => v.value))
		$('.shortest-path').html(`
			<div class="path-wrap">
				<div class="line">
					<span class="lbl">최단 경로 :</span>
					<p class="desc">
					${path.map((v, k) => `
						${k > 0 ? `<i class="fas fa-long-arrow-alt-right"></i> <span class="cost">${cost[k]} 분</span>` : ''}
						${Path.lbl[v]}
					`).join('')}
					</p>
				</div>
				<div class="line">
					<span class="lbl">소요 시간 :</span>
					<p class="desc">${min} 분</p>
				</div>
			</div>
		`)
		return false
	}

	// timeTable
	static timeTableView () { return (Layer.realOpen(Path.timeTable), false) }
}