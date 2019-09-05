var jsonUrl = []
var jsonName = []
var jsonSize = []

const model = new class{
	init () {
		this.db = openDatabase("Receipt","1.0","Daegu3",2*1024*1024)
		const sql = `CREATE TABLE IF NOT EXISTS receipts (idx integer primary key,file_url,file_size integer,file_name,datetime datetime,date date,classification,type,amount integer,card_info,card_number,approval,company_name,company_number,address,call)`
		return new Promise(async resolve => {
			await this.query(sql)
			resolve()
		})
	}

	query (sql,arr = [],await = true) {
		console.log(sql)
		return new Promise (resolve => {
			this.db.transaction(tx => {tx.executeSql(sql,arr,(tx,res) => {resolve(res)},(tx,error) => {console.log(error)})})
		})
	}
}

function loadOn () {
	model.init()
	getList()

	$("td.has-text-centered").parent("tr").addClass('emptyMsg')
}

async function modal () {
	let targetName = $(this).data("target")
	if(targetName == "Receipt"){
		$("#Receipt footer").append('<input type="file" name="file[]" style="display:none;" />')
	}
	target = $("#"+targetName)
	target.css({display:"flex"})
	if(targetName == "Initialization"){
		let receipt = await model.query(`SELECT * FROM receipts`)
		let cnt = receipt.rows.length
		$("#Initialization table tr:first-child strong").text(cnt)
	}
	if(targetName == "DetailDownload"){
		let idx = $(this).data("idx")
		let info = await model.query(`SELECT idx, file_name, file_size FROM receipts where idx = ${idx}`)
		for (const data of info.rows) {
			$("#DetailDownload table a").text(data.file_name+" ")
			let text = `<span class="tag is-info">${getKb(data.file_size)}</span>`
			$("#DetailDownload table a").append(text)
			$("#DetailDownload footer button").data("idx",data.idx)
		}
		$("#DetailDownload footer .field #radio-png2").data("ext","png")
		$("#DetailDownload footer .field #radio-jpg2").data("ext","jpg")
	}
	if (target.find('tr:not(.emptyMsg)').length) {
		$(".emptyMsg",target).hide()
		$("footer .is-success",target).prop("disabled",false).removeAttr("disabled")
	}

	$(".modal-close").click(() => {
		jsonUrl = []
		target.hide()
		target.find("tr:not(.emptyMsg)").remove()
		target.find(".emptyMsg").show()
		$("footer .is-success",target).prop("disabled",true).attr("disabled","disabled")
	})
}

async function getList () {
	let target = $(".main > .list > .panel")
	$("*",target).remove()
	const dateList = await model.query(`SELECT date, datetime FROM receipts group by date order by date desc`)
	let first = true
	for (const datetime of dateList.rows) {
		let dateText = `
			<a class="panel-block panel-date">
		        <span class="panel-icon">
		          <i class="far fa-calendar-alt" aria-hidden="true"></i>
		        </span>
		        <small>{{date}}</small>
		    </a>`
		dateText = dateText.replace(/{{date}}/gi,getDate(datetime.datetime))
		target.append(dateText)
		let list = await model.query(`SELECT idx, card_info, company_name, file_name, classification, amount FROM receipts where date = '${datetime.date}'  order by datetime desc`)
		for (const data of list.rows){
			let receipt = `
	            <a class="panel-block" data-idx="{{idx}}">
	                <span class="panel-icon">
	                  <i class="{{card_info}}" aria-hidden="true"></i>
	                </span>
	                <small>{{company_name}} [{{file_name}}]</small>
	                <span class="panel-price is-pulled-right has-text-{{color}}">
	                    {{classification}}{{amount}}<small>원</small>
	                </span>
	            </a>`
	        receipt = receipt
	        			.replace(/{{idx}}/gi,data.idx)
	        			.replace(/{{card_info}}/gi,data.classification == "Cancellation" ? "fas fa-undo" : data.card_info == "VISA" ? "fab fa-cc-visa" : "fab fa-cc-mastercard")
	        			.replace(/{{company_name}}/gi,data.company_name)
	        			.replace(/{{file_name}}/gi,data.file_name)
	        			.replace(/{{color}}/gi,data.classification == "Payment" ? "danger" : "link")
	        			.replace(/{{classification}}/gi,data.classification == "Payment" ? "-" : "+")
	        			.replace(/{{amount}}/gi,numberFormat(data.amount))
			target.append(receipt)
			if(first){
				$(".panel-block").addClass('is-active')
				first = false
			}
		}
	}

	receiptInfo()
}

function active () {
	$(".is-active").removeClass('is-active')
	$(this).addClass('is-active')
	receiptInfo()
}

async function receiptInfo () {
	$(".detail > *").remove()
	let target = $("a.panel-block.is-active:not(.panel-date)")
	let idx = target.data("idx")
	const info = await model.query(`SELECT * FROM receipts where idx = ${idx}`)
	for (const data of info.rows) {
		let text = `
            <div class="detail-content content">
                <h1>{{classification}}
                    <a class="button is-pulled-right is-rounded detailBtn" data-idx="{{idx}}">상세보기</a>
                    <a class="button is-pulled-right is-rounded undetailBtn" style="display:none">일반보기</a>
                </h1>
                <p>{{date}} {{time}}</p>
                <h3>{{company_name}}
                    <span class="is-pulled-right card-visa">
                        <i class="fab fa-cc-{{card_info}}"></i>&nbsp;{{card_name}}
                    </span>
                </h3>
                <hr>
                <h1 class="is-marginless has-text-right">
                    <span class="is-pulled-left">거래금액</span>
                    <span class="has-text-danger">{{amount}}<small>원</small></span>
                </h1>
            </div>

            <div class="field is-grouped is-pulled-right">
                <p class="control">
                    <a download="{{file_name}}" href="{{file_url}}"  class="button is-rounded downloadbtn">내보내기</a>
                </p>
                <p class="control">
                    <a data-idx="{{idx}}" class="button is-rounded modal-button .detailDownloadBtn" data-target="DetailDownload">다운로드</a>
                </p>
                <p class="control">
                    <a data-idx="{{idx}}" class="button is-rounded">삭제</a>
                </p>
            </div>`
        text = text
        		.replace(/{{classification}}/gi,data.classification == "Payment" ? "결제" : "취소")
        		.replace(/{{date}}/gi,getDate(data.datetime))
        		.replace(/{{time}}/gi,getTime(data.datetime))
        		.replace(/{{company_name}}/gi,data.company_name)
        		.replace(/{{card_info}}/gi,data.card_info == "VISA" ? "visa" : "mastercard")
        		.replace(/{{card_name}}/gi,data.card_info == "VISA" ? "비자카드" : "마스터카드")
        		.replace(/{{amount}}/gi,numberFormat(data.amount))
        		.replace(/{{idx}}/gi,data.idx)
        		.replace(/{{file_name}}/gi,data.file_name)
        		.replace(/{{file_url}}/gi,data.file_url)
        $(".detail").append(text)
	}
}

async function viewDetail () {
	let idx = $(this).data("idx")
	$(this).hide()
	$(".undetailBtn").show()
	let info = await model.query(`SELECT * FROM receipts where idx = ${idx}`)
	for (const data of info.rows) {
		let text = `
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">거래시각</span>
                <span>{{date}} {{time}}</span>
            </p>
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">거래구분</span>
                <span>{{classification}}</span>
            </p>
            <p class="has-text-right">
                <span class="is-pulled-left">거래형태</span>
                <span>{{type}}</span>
            </p>
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">카드정보</span>
                <span>{{card_info}}</span>
            </p>
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">카드번호</span>
                <span>{{card_number}}</span>
            </p>
            <p class="has-text-right">
                <span class="is-pulled-left">승인번호</span>
                <span>{{approval}}</span>
            </p>
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">사용처</span>
                <span>{{company_name}}</span>
            </p>
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">주소</span>
                <span>{{address}}</span>
            </p>
            <p class="is-marginless has-text-right">
                <span class="is-pulled-left">전화번호</span>
                <span>{{call}}</span>
            </p>`
        text = text
        	.replace(/{{date}}/gi,getDate(data.datetime))
        	.replace(/{{time}}/gi,getTime(data.datetime))
        	.replace(/{{classification}}/gi,data.classification == "Payment" ? "결제" : "취소")
        	.replace(/{{type}}/gi,data.type == "Online" ? "온라인" : "오프라인")
        	.replace(/{{card_info}}/gi,data.card_info == "VISA" ? "비자카드" : "마스터카드")
        	.replace(/{{card_number}}/gi,data.card_number)
        	.replace(/{{approval}}/gi,data.approval)
        	.replace(/{{company_name}}/gi,data.company_name)
        	.replace(/{{address}}/gi,data.address)
        	.replace(/{{call}}/gi,data.call)
       	$(".detail-content").append(text)
	}
	$(".undetailBtn").click(() => {
		$(".undetailBtn").hide()
		$(".detailBtn").show()
		$(".detail-content > p.has-text-right").remove()
	})
}

async function detailDownload () {
	if (!$('#canvas').length) {
		$('body').append('<canvas width="330" height="420" id="canvas" style="display:none;"></canvas>')
	}
	let idx = $(this).data("idx")
	let ext = $("#DetailDownload footer .field input:checked").data("ext")
	let info = await model.query(`SELECT * FROM receipts where idx = ${idx}`)
	let template = `
		<svg xmlns="http://www.w3.org/2000/svg" width="330" height="420">
			<foreignObject width="100%" height="100%">
				<div xmlns="http://www.w3.org/1999/xhtml">
					<h1 style="text-align:center;font-size:25px;font-weight:lighter;margin:0;padding:0;line-height:60px;">스마트 영수증</h1>
					<div style="padding:10px 0;border-bottom:2px dashed #000;width:300px;margin:0 auto;">
						<div style="font-size:15px;">사용처 : {{company_name}}</div>
						<div style="font-size:15px;">가맹점번호 : {{company_number}}</div>
						<div style="font-size:15px;">전화번호 : {{call}}</div>
						<div style="font-size:15px;">주소 : {{address}}</div>
					</div>
					<div style="padding:10px 0;padding-top:0;border-bottom:2px dashed #000;width:300px;margin:0 auto;">
						<h2 style="font-size:18px;font-weight:lighter;text-align:center;margin:0;padding:0;line-height:40px;">[ {{type}} {{classification}}]</h2>
						<div style="font-size:15px;">카드종류 : {{card_info}}</div>
						<div style="font-size:15px;">카드번호 : {{card_number}}</div>
						<div style="font-size:15px;">거래승인 : {{approval}}</div>
						<div style="font-size:15px;">거래일시 : {{date}} {{time}}</div>
					</div>
					<div style="padding:10px 0;border-bottom:2px dashed #000;width:300px;margin:0 auto;">
						<div>거래금액 : <span style="position:absolute;right:10px;">{{amount}}원</span></div>
						<div>부가 : <span style="position:absolute;right:10px;">0원</span></div>
						<div>합계 : <span style="position:absolute;right:10px;">{{amount}}원</span></div>
					</div>
					<div style="line-height:40px;width:300px;margin:0 auto;">감사합니다!</div>
				</div>
			</foreignObject>
		</svg>`
	const canvas = document.getElementById('canvas')
	for (const data of info.rows) {
		(function () {
			let text = template
					.replace(/{{company_name}}/gi,data.company_name)
					.replace(/{{company_number}}/gi,data.company_number)
					.replace(/{{call}}/gi,data.call)
					.replace(/{{address}}/gi,data.address)
					.replace(/{{type}}/gi,data.type == "Online" ? "온라인" : "오프라인")
					.replace(/{{classification}}/gi,data.classification == "Payment" ? "결제" : "취소")
					.replace(/{{card_info}}/gi,data.card_info == "VISA" ? "비자카드" : "마스터카드")
					.replace(/{{card_number}}/gi,data.card_number)
					.replace(/{{approval}}/gi,data.approval)
					.replace(/{{date}}/gi,getDate(data.date).replace("(\[가-힣]\)"),"")
					.replace(/{{time}}/gi,getTime(data.time))
					.replace(/{{amount}}/gi,numberFormat(data.amount))
			text = encodeURIComponent(text);
			const ctx = canvas.getContext('2d')
			const img = new Image()
			img.src = "data:image/svg+xml," + text
		    img.onload = function() {
		        ctx.drawImage(img, 0, 0);
		        var imgURI = canvas
		            .toDataURL('image/png')
		            .replace('image/png', 'image/octet-stream');
		        triggerDownload(imgURI)
		    }
		})()
	}
}

function triggerDownload(imgURI) {
    var evt = new MouseEvent('click', {
        view: window,
        bubbles: false,
        cancelable: true
    });
    var a = document.createElement('a');
    a.setAttribute('download', 'MY_COOL_IMAGE.png');
    a.setAttribute('href', imgURI);
    a.setAttribute('target', '_blank');
    a.dispatchEvent(evt);
}

function clickFileSelector () {
	let parent = $(this).parents('footer')
	$("input[type='file']",parent).click()
	return false
}

function jsonTempReceipt (evt) {
	let files = evt.target.files

	for (let i = 0, f; f = files[i]; i++) {

		if(f.type.indexOf('json') == -1){
			alert("json파일만 선택 할 수 있습니다.")
			return false
		}

		let reader = new FileReader()
		reader.onload = (theFile => {
			return e => {
				jsonUrl.push(e.target.result)
				jsonName.push(theFile.name)
				jsonSize.push(f.size)
				let idx = jsonUrl.length - 1
                let text = `
	                <tr>
	                    <td>
	                        <a>{{name}} <span class="tag is-info">{{size}}</span></a>
	                        <button class="delete is-pulled-right" aria-label="close" data-idx="{{idx}}"></button>
	                    </td>
	                </tr>`
	            text = text
	            		.replace(/{{name}}/gi,theFile.name)
	            		.replace(/{{size}}/gi,getKb(f.size))
	            		.replace(/{{idx}}/gi,idx)

	            if($("#Receipt").find(".emptyMsg").length) $("#Receipt .emptyMsg").hide()
	            $("#Receipt table").prepend(text)
        		$("#Receipt footer .is-success").prop("disabled",false).removeAttr("disabled")
	        	return false
			}
		})(f)

		reader.readAsDataURL(f)
	}
}

async function fileInsert () {
	for (var i = jsonUrl.length - 1; i >= 0; i--) {
		if (jsonUrl[i] == "" && jsonName[i] == "") continue
		await $.post(jsonUrl[i], async data => {
			var file_url = jsonUrl[i]
			var file_name = jsonName[i]
			var file_size = jsonSize[i]
			const fileData = await model.query(`SELECT * FROM receipts where file_name = '${file_name}'`)
			if(fileData.rows.length) return
			var datetime, date, classification, type, amount, card_info, card_number, approval, company_name, company_number, address, call
			await $.each(data,(key,obj) => {
				switch (key) {
					case "transaction" :
						datetime = new Date(obj.date+" "+obj.time)
						date = (obj.date.replace(".",""))*1
						classification = obj.classification
						type = obj.type
						amount = obj.amount
						break
					case "card" :
						card_info = obj.information
						card_number = obj.number
						approval = obj.approval
						break
					case "more" :
						company_name = obj.name
						company_number = obj.number
						address = obj.address
						call = obj.call
						break
				}
			})
			await model.query(`INSERT INTO receipts (file_url,file_name,file_size,datetime,date,classification,type,amount,card_info,card_number,approval,company_name,company_number,address,call) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)`,[file_url,file_name,file_size,datetime,date,classification,type,amount,card_info,card_number,approval,company_name,company_number,address,call])
		})
	}
	jsonUrl = []
	jsonName = []
	alert("추가되었습니다")
	location.reload()
}

function deleteTr () {
	let idx = $(this).data("idx")
	let parent = $(this).parents("tr")
	let table = $(this).parents("table")
	parent.remove()
	delete jsonUrl[idx]
	delete jsonName[idx]
	delete jsonSize[idx]
	if(!table.find("tr:not(.emptyMsg)").length){
		$("footer .is-success",table).prop("disabled",true).attr("disabled","disabled")
		$(".emptyMsg",table).show()
	}
}

async function truncateReceipt () {
	await model.query(`DELETE FROM receipts`)
	alert("초기화되었습니다")
	location.reload()
}

function getDate (datetime) {
	let FullDate = new Date(datetime)
	let year = FullDate.getFullYear()
	let month = FullDate.getMonth() + 1
	let date = FullDate.getDate()
	let day = FullDate.getDay()
	switch (day) {
		case 0:
			day = "일"
			break
		case 1:
			day = "월"
			break
		case 2:
			day = "화"
			break
		case 3:
			day = "수"
			break
		case 4:
			day = "목"
			break
		case 5:
			day = "금"
			break
		case 6:
			day = "토"
			break
		case 7:
			day = "일"
			break
	}
	if (month < 10) month = "0"+month
	if (date < 10) date = "0"+date
	return year+"."+month+"."+date+" ("+day+")"
}

function getTime (datetime) {
	let time = new Date(datetime)
	let hour = time.getHours()
	let minute = time.getMinutes()
	let second = time.getSeconds()
	return hour+":"+minute+":"+second
}

function numberFormat (num) {
	let reg = /(^[+-]?\d+)(\d{3})/
	num += ''
	while (reg.test(num)) {
		num = num.replace(reg,'$1'+','+'$2')
	}
	return num
}

function getKb (size) {
	size /= 1024
	if (size <= 1) {
		return "1KB"
	} else {
		return ceil(size)+"KB"
	}
}

$(loadOn)
.on("click",".modal-button",modal)
.on("click",".delete",deleteTr)
.on("click",".panel-block:not(.is-active)",active)
.on("click",".detail-content h1:first-child .detailBtn",viewDetail)
.on("change","#Receipt input[type='file']",jsonTempReceipt)
.on("click","#Receipt footer > button:first-child",clickFileSelector)
.on("click","#Receipt footer > .is-success",fileInsert)
.on("click","#Initialization footer > button",truncateReceipt)
.on("click","#DetailDownload footer button",detailDownload)